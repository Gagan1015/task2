<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Traits\UploadsToCloudinary;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use UploadsToCloudinary;
    /**
     * General settings page
     */
    public function general()
    {
        $settings = SiteSetting::getByGroup('general');
        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Update general settings
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:1024',
        ]);

        SiteSetting::set('site_name', $request->site_name, 'text', 'general');
        SiteSetting::set('site_tagline', $request->site_tagline, 'text', 'general');
        SiteSetting::set('contact_email', $request->contact_email, 'text', 'general');
        SiteSetting::set('contact_phone', $request->contact_phone, 'text', 'general');
        SiteSetting::set('address', $request->address, 'text', 'general');

        if ($request->hasFile('logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            $this->deleteFromCloudinary($oldLogo);
            $path = $this->uploadToCloudinary($request->file('logo'), 'settings');
            SiteSetting::set('site_logo', $path, 'image', 'general');
        }

        return back()->with('success', 'General settings updated successfully.');
    }

    /**
     * Appearance settings page
     */
    public function appearance()
    {
        $settings = SiteSetting::getByGroup('appearance');
        return view('admin.settings.appearance', compact('settings'));
    }

    /**
     * Update appearance settings
     */
    public function updateAppearance(Request $request)
    {
        $request->validate([
            'primary_color' => 'nullable|string|max:20',
            'secondary_color' => 'nullable|string|max:20',
            'header_style' => 'nullable|in:light,dark',
            'footer_style' => 'nullable|in:light,dark',
        ]);

        SiteSetting::set('primary_color', $request->primary_color ?? '#F97316', 'text', 'appearance');
        SiteSetting::set('secondary_color', $request->secondary_color ?? '#1F2937', 'text', 'appearance');
        SiteSetting::set('header_style', $request->header_style ?? 'light', 'text', 'appearance');
        SiteSetting::set('footer_style', $request->footer_style ?? 'dark', 'text', 'appearance');

        return back()->with('success', 'Appearance settings updated successfully.');
    }

    /**
     * Social settings page
     */
    public function social()
    {
        $settings = SiteSetting::getByGroup('social');
        return view('admin.settings.social', compact('settings'));
    }

    /**
     * Update social settings
     */
    public function updateSocial(Request $request)
    {
        $request->validate([
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        SiteSetting::set('facebook_url', $request->facebook_url, 'text', 'social');
        SiteSetting::set('twitter_url', $request->twitter_url, 'text', 'social');
        SiteSetting::set('instagram_url', $request->instagram_url, 'text', 'social');
        SiteSetting::set('youtube_url', $request->youtube_url, 'text', 'social');
        SiteSetting::set('linkedin_url', $request->linkedin_url, 'text', 'social');

        return back()->with('success', 'Social links updated successfully.');
    }
}
