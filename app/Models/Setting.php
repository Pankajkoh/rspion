<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    protected $table = 'settings';
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['key', 'value'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('website_logo')->singleFile();
        $this->addMediaCollection('website_footer_logo')->singleFile();
    }


    public static function getValue($key, $default = null)
    {

        $setting = self::where('key', $key)->first();
        // return $setting ? $setting->setting_value : $default;
        return  $setting ? $setting->value : '';
    }

    public static function setValue($name, $value)
    {
        $setting = self::updateOrCreate(['key' => $name], ['value' => $value]);
        return $setting;
    }

    public static function getLogoUrl()
    {
        $website_logo = self::where('key', 'website_logo')->first();
        $website_footer_logo = self::where('key', 'website_footer_logo')->first();

        $websiteLogoUrl = $website_logo ? $website_logo->getFirstMediaUrl('website_logo') : null;
        $footerLogoUrl = $website_footer_logo ? $website_footer_logo->getFirstMediaUrl('website_footer_logo') : null;
        return [
            'website_logo' => $websiteLogoUrl,
            'website_footer_logo' => $footerLogoUrl,
        ];
    }

    public function getSettings()
    {
        // website name
        $website_name = self::getValue('website_name');
        // website email
        $website_email = self::getValue('website_email');
        // website admin notification email
        $notification_email = self::getValue('notification_email');
        // website phone number
        $website_phone_number = self::getValue('website_phone_number');
        // website address
        $address = self::getValue('address');
        // website footer description
        $website_description = self::getValue('website_description');
        // website facebook url
        $facebook_url = self::getValue('facebook_url');
        $facebook_status = self::getValue('facebook_status');
        // website twitter url
        $twitter_url = self::getValue('twitter_url');
        $twitter_status = self::getValue('twitter_status');
        // website instagram url
        $instagram_url = self::getValue('instagram_url');
        $instagram_status = self::getValue('instagram_status');
        // website watsap url
        $whatsapp_url = self::getValue('whatsapp_url');
        $whatsapp_status = self::getValue('whatsapp_status');
        // website linkedIN url
        $linkedin_url = self::getValue('linkedin_url');
        $linkedin_status = self::getValue('linkedin_status');
        // website logo
        $logos = self::getLogoUrl();
        $website_logo = $logos['website_logo'];
        $website_footer_logo = $logos['website_footer_logo'];

        $data['website_name'] = $website_name;
        $data['website_email'] = $website_email;
        $data['notification_email'] = $notification_email;
        $data['website_phone_number'] = $website_phone_number;
        $data['address'] = $address;
        $data['website_description'] = $website_description;
        $data['facebook_url'] = $facebook_url;
        $data['facebook_status'] = $facebook_status;
        $data['twitter_url'] = $twitter_url;
        $data['twitter_status'] = $twitter_status;
        $data['instagram_url'] = $instagram_url;
        $data['instagram_status'] = $instagram_status;
        $data['whatsapp_url'] = $whatsapp_url;
        $data['whatsapp_status'] = $whatsapp_status;
        $data['linkedin_url'] = $linkedin_url;
        $data['linkedin_status'] = $linkedin_status;
        $data['website_logo'] = $website_logo;
        $data['website_footer_logo'] = $website_footer_logo;
        $data['website_domain'] = $_SERVER['HTTP_HOST'];
        return $data;
    }
}
