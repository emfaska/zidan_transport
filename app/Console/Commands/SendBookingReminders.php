<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send WhatsApp reminders for upcoming bookings (H-1 and H-2 Hours)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $fonnte = new \App\Services\FonnteService();
        $now = \Carbon\Carbon::now();

        // 1. H-1 Reminders (Tomorrow's trips)
        $tomorrow = \Carbon\Carbon::tomorrow()->toDateString();
        $h1Bookings = \App\Models\Booking::where('status', 'confirmed')
            ->whereDate('tanggal_berangkat', $tomorrow)
            ->where('notified_h1', false)
            ->whereNotNull('driver_id')
            ->get();

        foreach ($h1Bookings as $booking) {
            $this->info("Sending H-1 Reminder for: {$booking->kode_booking}");
            $fonnte->sendH1Reminder($booking);
            $booking->update(['notified_h1' => true]);
        }

        // 2. H-2H Reminders (Trips starting in 1-2 hours)
        // We look for today's trips where current time + 2 hours >= waktu_jemput
        $h2hBookings = \App\Models\Booking::where('status', 'confirmed')
            ->whereDate('tanggal_berangkat', \Carbon\Carbon::today())
            ->where('notified_h2h', false)
            ->whereNotNull('driver_id')
            ->get()
            ->filter(function($booking) use ($now) {
                // Combine date and time for comparison
                $departureTime = \Carbon\Carbon::parse($booking->tanggal_berangkat->format('Y-m-d') . ' ' . $booking->waktu_jemput->format('H:i:s'));
                $diffInMinutes = $now->diffInMinutes($departureTime, false);
                // Trigger if trip is between 60 mins and 120 mins away
                return $diffInMinutes <= 120 && $diffInMinutes >= 0;
            });

        foreach ($h2hBookings as $booking) {
            $this->info("Sending H-2H Reminder for: {$booking->kode_booking}");
            $fonnte->sendH2HReminder($booking);
            $booking->update(['notified_h2h' => true]);
        }

        $this->info('Reminders check completed.');
    }
}
