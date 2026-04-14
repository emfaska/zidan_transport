<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            [
                'key' => 'site_name',
                'value' => 'Zidan Transport',
                'display_name' => 'Nama Situs',
                'type' => 'text',
                'group' => 'general'
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'display_name' => 'Logo Situs',
                'type' => 'image',
                'group' => 'general'
            ],
            
            // Contact
            [
                'key' => 'contact_whatsapp',
                'value' => '628123456789',
                'display_name' => 'WhatsApp CS',
                'type' => 'text',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_whatsapp_display',
                'value' => '+62 821-4295-1682',
                'display_name' => 'Tampilan Nomor WA',
                'type' => 'text',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Kediri, Jawa Timur',
                'display_name' => 'Alamat Kantor',
                'type' => 'textarea',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_email',
                'value' => 'admin@zidantransport.com',
                'display_name' => 'Email Resmi',
                'type' => 'text',
                'group' => 'contact'
            ],

            // Finance
            [
                'key' => 'driver_commission_percent',
                'value' => '25',
                'display_name' => 'Komisi Driver (%)',
                'type' => 'number',
                'group' => 'finance'
            ],
            [
                'key' => 'min_withdrawal_amount',
                'value' => '10000',
                'display_name' => 'Minimal Pencairan (Rp)',
                'type' => 'number',
                'group' => 'finance'
            ],

            // SEO
            [
                'key' => 'meta_description',
                'value' => 'Zidan Transport - Layanan Sewa Mobil dan Travel Terpercaya di Kediri dengan Armada Modern dan Driver Profesional.',
                'display_name' => 'Deskripsi SEO',
                'type' => 'textarea',
                'group' => 'seo'
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'travel kediri, sewa mobil kediri, zidan transport, rental mobil kediri, travel surabaya kediri, travel malang kediri',
                'display_name' => 'Kata Kunci SEO',
                'type' => 'textarea',
                'group' => 'seo'
            ],
            [
                'key' => 'og_image',
                'value' => 'images/logo.png',
                'display_name' => 'Gambar Berbagi Sosial (OG Image)',
                'type' => 'image',
                'group' => 'seo'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
