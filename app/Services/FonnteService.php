<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;

class FonnteService
{
    protected $token;
    protected $apiUrl = 'https://api.fonnte.com/send';

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    /**
     * Send a basic WA message
     */
    public function sendMessage($target, $message)
    {
        if (empty($this->token)) {
            Log::warning('Fonnte token not found. WhatsApp message not sent.');
            return false;
        }

        if (empty($target)) {
            Log::warning('Fonnte target phone number empty. WhatsApp message not sent.');
            return false;
        }

        // Format target number (replace leading 0 with 62)
        $target = $this->formatPhoneNumber($target);

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->apiUrl, [
                'target' => $target,
                'message' => $message,
                'delay' => '2',
                'prm' => true // Enable parameter syntax support from Fonnte if needed
            ]);

            $result = $response->json();
            
            if (isset($result['status']) && $result['status'] == true) {
                Log::info("WhatsApp message sent successfully to {$target}");
                return true;
            } else {
                Log::error("Failed to send WA message to {$target}: " . json_encode($result));
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Fonnte API Exception: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Format phone number to start with 62.
     */
    protected function formatPhoneNumber($number)
    {
        // Remove spaces, dashes, etc
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // Replace leading 0 with 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }
        
        // Add 62 if it doesn't start with 62
        if (substr($number, 0, 2) !== '62') {
            $number = '62' . $number;
        }
        
        return $number;
    }

    public function sendCheckoutInvoice(Booking $booking)
    {
        $user = $booking->user;
        $total = number_format($booking->total_akhir ?? $booking->total_harga, 0, ',', '.');
        $date = $booking->tanggal_berangkat->format('d M Y');
        $time = $booking->waktu_jemput->format('H:i');
        
        $message = "Halo *{$user->name}*, terima kasih telah melakukan pemesanan di *Zidan Transport*.\n\n";
        $message .= "Berikut ringkasan pesanan Anda:\n";
        $message .= "🎫 Kode Booking: *{$booking->kode_booking}*\n";
        $message .= "🗺️ Rute: {$booking->rute->nama_rute}\n";
        $message .= "📅 Jadwal Jemput: {$date} pukul {$time} WIB\n";
        $message .= "💵 Total Tagihan: *Rp {$total}*\n\n";
        $message .= "Mohon segera selesaikan pembayaran tagihan agar pesanan dapat kami proses.\n";
        $message .= "Jika Anda telah membayar sebelumnya, mohon abaikan pesan ini.\n\n";
        $message .= "CS Admin: wa.me/6282142951682";

        return $this->sendMessage($user->no_hp, $message);
    }

    public function sendPaymentSuccess(Booking $booking)
    {
        $user = $booking->user;
        $message = "Halo *{$user->name}*!\n\n";
        $message .= "🎉 Pembayaran LUNAS untuk pesanan *{$booking->kode_booking}* telah berhasil kami terima.\n";
        $message .= "Pesanan Anda dijadwalkan pada {$booking->tanggal_berangkat->format('d M Y')}.\n";
        $message .= "Admin kami akan segera menghubungi Anda kembali beserta informasi pengemudi Anda pada hari H.\n\n";
        $message .= "Terima kasih telah mempercayakan perjalanan Anda pada Zidan Transport!";

        return $this->sendMessage($user->no_hp, $message);
    }

    public function sendDriverAssignment(Booking $booking)
    {
        // Notify Customer
        $user = $booking->user;
        $driver = $booking->driver;
        $armada = $booking->armada;

        $messageToUser = "Halo *{$user->name}*!\n\n";
        $messageToUser .= "Pengemudi untuk pesanan jadwal keberangkatan Anda (Kode: *{$booking->kode_booking}*) telah ditentukan.\n\n";
        $messageToUser .= "🚘 *Detail Armada*: " . ($armada->nama ?? 'Standar Zidan') . "\n";
        $messageToUser .= "👨🏻‍✈️ *Nama Pengemudi*: {$driver->name}\n";
        $messageToUser .= "📞 *Kontak Pengemudi*: wa.me/" . $this->formatPhoneNumber($driver->no_hp) . "\n\n";
        $messageToUser .= "Pengemudi akan menjemput Anda di lokasi:\n*{$booking->rute->lokasi_awal}*\npada {$booking->tanggal_berangkat->format('d M Y')} pukul {$booking->waktu_jemput->format('H:i')} WIB.\n\n";
        $messageToUser .= "Semoga perjalanan Anda menyenangkan bersama Zidan Transport!";

        $this->sendMessage($user->no_hp, $messageToUser);

        // Notify Driver
        $messageToDriver = "Halo *{$driver->name}*!\n\n";
        $messageToDriver .= "Ada *Tugas Baru* untuk pesanan *{$booking->kode_booking}*.\n\n";
        $messageToDriver .= "👤 *Pelanggan*: {$user->name} (wa.me/" . $this->formatPhoneNumber($user->no_hp) . ")\n";
        $messageToDriver .= "📍 *Titik Jemput*: {$booking->rute->lokasi_awal}\n";
        $messageToDriver .= "🏁 *Tujuan Akhir*: {$booking->rute->tujuan}\n";
        $messageToDriver .= "⏰ Waktu: *{$booking->tanggal_berangkat->format('d M Y')} pukul {$booking->waktu_jemput->format('H:i')} WIB*\n\n";
        if($booking->catatan_customer) {
            $messageToDriver .= "📝 Catatan Pelanggan: _{$booking->catatan_customer}_\n\n";
        }
        $messageToDriver .= "Silakan cek halaman dashboard PENGEMUDI di web untuk kelola job. Pastikan tepat waktu!";

        return $this->sendMessage($driver->no_hp, $messageToDriver);
    }

    public function sendCancellation(Booking $booking)
    {
        $user = $booking->user;
        $message = "Halo *{$user->name}*.\n\n";
        $message .= "Pesanan Anda dengan kode *{$booking->kode_booking}* telah berhasil *DIBATALKAN*.\n";
        $message .= "Jika Anda mengajukan pengembalian dana (Refund), silakan periksa mutasi akun Anda secara berkala dan lakukan konfirmasi.\n\n";
        $message .= "Silakan hubungi CS kami di wa.me/6282142951682 jika Anda membutuhkan bantuan lebih lanjut.";

        return $this->sendMessage($user->no_hp, $message);
    }

    public function sendExtensionRequestToAdmin(\App\Models\BookingExtension $extension)
    {
        $booking = $extension->booking;
        $user = $booking->user;
        $adminPhone = '6282142951682'; // Base Admin Phone
        
        $message = "🔔 *PESANAN PERPANJANGAN BARU*\n\n";
        $message .= "Pelanggan *{$user->name}* mengajukan perpanjangan waktu untuk pesanan *{$booking->kode_booking}*.\n\n";
        $message .= "📅 Tanggal Baru: *{$extension->new_return_date->format('d M Y')}*\n";
        $message .= "📝 Alasan: _{$extension->reason}_\n\n";
        $message .= "Silakan tinjau dan tentukan harga tambahan di Panel Admin.";

        return $this->sendMessage($adminPhone, $message);
    }

    public function sendExtensionStatusToCustomer(\App\Models\BookingExtension $extension)
    {
        $booking = $extension->booking;
        $user = $booking->user;
        $status = strtoupper($extension->status);
        
        $message = "Halo *{$user->name}*!\n\n";
        $message .= "Update untuk pengajuan perpanjangan waktu pesanan *{$booking->kode_booking}*:\n";
        $message .= "Status: *{$status}*\n";
        
        if ($extension->status === 'approved') {
            $message .= "💰 Harga Tambahan: *Rp " . number_format($extension->additional_price, 0, ',', '.') . "*\n";
            $message .= "📅 Jadwal Baru: *{$extension->new_return_date->format('d M Y')}*\n\n";
            $message .= "Terima kasih telah mempercayakan Zidan Transport!";
        } elseif ($extension->status === 'rejected') {
            $message .= "❌ Alasan Penolakan: _{$extension->admin_notes}_\n\n";
            $message .= "Silakan hubungi admin jika ada pertanyaan.";
        }

        return $this->sendMessage($user->no_hp, $message);
    }

    public function sendH1Reminder(Booking $booking)
    {
        $user = $booking->user;
        $driver = $booking->driver;
        $tanggal = $booking->tanggal_berangkat->format('d M Y');
        $jam = $booking->waktu_jemput->format('H:i');

        // To Customer
        $msgUser = "🔔 *PENGINGAT (H-1)*\n\n";
        $msgUser .= "Halo *{$user->name}*, ini adalah pengingat untuk pesanan *{$booking->kode_booking}* Anda.\n\n";
        $msgUser .= "📅 Jadwal: *Besok, {$tanggal}*\n";
        $msgUser .= "⏰ Jam Jemput: *{$jam} WIB*\n";
        $msgUser .= "👨🏻‍✈️ Driver: *{$driver->name}*\n\n";
        $msgUser .= "Mohon bersiap di lokasi penjemputan. Sampai jumpa besok! 🚕✨";
        $this->sendMessage($user->no_hp, $msgUser);

        // To Driver
        $msgDriver = "🔔 *LOGISTIK (H-1)*\n\n";
        $msgDriver .= "Halo *{$driver->name}*, Anda memiliki jadwal keberangkatan BESOK.\n\n";
        $msgDriver .= "🎫 Kode: *#{$booking->kode_booking}*\n";
        $msgDriver .= "👤 Pelanggan: *{$user->name}*\n";
        $msgDriver .= "⏰ Jam Jemput: *{$jam} WIB*\n\n";
        $msgDriver .= "Pastikan armada dalam kondisi prima dan bahan bakar terisi. Selamat bertugas!";
        return $this->sendMessage($driver->no_hp, $msgDriver);
    }

    public function sendH2HReminder(Booking $booking)
    {
        $user = $booking->user;
        $driver = $booking->driver;
        $jam = $booking->waktu_jemput->format('H:i');

        // To Customer
        $msgUser = "⚠️ *PENGINGAT TERAKHIR (SIAP-SIAP)*\n\n";
        $msgUser .= "Halo *{$user->name}*, perjalanan Anda akan dimulai dalam *1-2 jam* lagi!\n\n";
        $msgUser .= "⏰ Jam Jemput: *{$jam} WIB*\n";
        $msgUser .= "👨🏻‍✈️ Driver: *{$driver->name}*\n\n";
        $msgUser .= "Mohon pastikan Anda sudah bersiap di lokasi penjemputan. Drive safe with us! 🚗💨";
        $this->sendMessage($user->no_hp, $msgUser);

        // To Driver
        $msgDriver = "⚠️ *PENGINGAT KEBERANGKATAN (2 JAM)*\n\n";
        $msgDriver .= "Halo *{$driver->name}*, waktu keberangkatan untuk tugas *#{$booking->kode_booking}* sudah dekat!\n\n";
        $msgDriver .= "⏰ Jam Jemput: *{$jam} WIB*\n";
        $msgDriver .= "👤 Pelanggan: *{$user->name}*\n\n";
        $msgDriver .= "Harap segera meluncur ke lokasi penjemputan. Jangan telat ya!";
        return $this->sendMessage($driver->no_hp, $msgDriver);
    }
}
