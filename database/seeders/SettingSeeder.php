<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            // General Settings
            'app_name' => 'Hotel Admin Panel',
            'app_logo' => null,                    // or 'uploads/logo.png'
            'favicon' => null,                    // or 'uploads/favicon.png'
            'meta_title' => 'Hotel Management System',
            'meta_description' => 'Best hotel management system for admins.',

            // Contact Details
            'contact_email' => 'info@hotel.com',
            'contact_phone' => '+977 9800000000',
            'contact_address' => 'Kathmandu, Nepal',

            // Social Links
            'facebook_url' => 'https://facebook.com/hotel',
            'twitter_url' => 'https://twitter.com/hotel',
            'linkedin_url' => 'https://linkedin.com/company/hotel',
            'instagram_url' => 'https://instagram.com/hotel',

            // Theme Colors (Default)
            'primary_color' => '#6B4C2B',
            'primary_hover' => '#5A3F20',
            'accent_color' => '#FF6F61',
            'sidebar_active_bg' => '#EFE7DF',
            'sidebar_hover_bg' => '#F5EFEA',
            'sidebar_active_text' => '#6B4C2B',
            'table_header_bg' => '#f9f6f2',
        ]);
    }
}
