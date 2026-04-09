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
        $this->token = env('FONNTE_TOKEN');
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
}
