<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
   protected $fillable = [
    'app_name', 'app_logo', 'favicon', 'meta_title', 'meta_description',
    'contact_email', 'contact_phone', 'contact_address',
    'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url',

    // Theme colors
    'primary_color', 'primary_hover',
    'sidebar_active_bg', 'sidebar_hover_bg', 'sidebar_active_text',
    'table_header_bg',
];

}
