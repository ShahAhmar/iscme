<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends Controller
{
    private const DEFAULT_CATEGORIES = [
        ['name' => 'International Authors', 'early_bird' => '$350', 'regular' => '$400'],
        ['name' => 'National Authors (Bulgaria)', 'early_bird' => '150 BGN', 'regular' => '200 BGN'],
        ['name' => 'International Listeners', 'early_bird' => '$150', 'regular' => '$180'],
        ['name' => 'National Listeners (Bulgaria)', 'early_bird' => '80 BGN', 'regular' => '100 BGN'],
    ];

    private const DEFAULTS = [
        'site_name' => 'ISCME 2027',
        'tagline' => 'International Scientific Conference on Management & Engineering',
        'contact_email' => 'iscme@gaftim.com',
        'contact_phone' => '+359-2-965-3237',
        'address' => 'Technical University of Sofia, Studentski grad, Sofia, Bulgaria',
        'venue_dates' => '2–4 June, 2027 • Sofia, Bulgaria',
        'copyright_text' => '© 2027 ISCME — International Scientific Conference on Management & Engineering. All rights reserved.',
        'technical_sponsor_name' => 'IEEE Bulgaria Section',
        'primary_color' => '#003D6C',
        'timezone' => 'Europe/Sofia',
        'facebook_url' => '',
        'linkedin_url' => '',
        'x_url' => '',
        'youtube_url' => '',
        'registration_status' => 'enabled',
        'registration_closed_message' => 'Pre-registration is currently closed for XXV ISCME 2027. Please check back later for updates.',
    ];

    public function index(): Response
    {
        $stored = SiteSetting::where('group', 'general')->get()->mapWithKeys(fn ($item) => [$item->key => $item->value['value'] ?? ''])->all();
        
        $settings = array_replace(self::DEFAULTS, $stored);

        // Check if registration_categories exists and has valid values
        $parsedCategories = json_decode($settings['registration_categories'] ?? '[]', true);
        if (empty($parsedCategories)) {
            $settings['registration_categories'] = json_encode(self::DEFAULT_CATEGORIES);
        }

        return Inertia::render('Admin/Settings/Index', ['settings' => $settings]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:120'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'string', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],
            'venue_dates' => ['nullable', 'string', 'max:255'],
            'copyright_text' => ['nullable', 'string', 'max:500'],
            'technical_sponsor_name' => ['nullable', 'string', 'max:255'],
            'primary_color' => ['nullable', 'string', 'max:20'],
            'timezone' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'string', 'max:2048'],
            'linkedin_url' => ['nullable', 'string', 'max:2048'],
            'x_url' => ['nullable', 'string', 'max:2048'],
            'youtube_url' => ['nullable', 'string', 'max:2048'],
            'registration_categories' => ['nullable'],
            'registration_status' => ['nullable', 'string', 'in:enabled,disabled'],
            'registration_closed_message' => ['nullable', 'string', 'max:500'],
        ]);

        if (isset($data['registration_categories']) && is_array($data['registration_categories'])) {
            $data['registration_categories'] = json_encode($data['registration_categories']);
        }

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['group' => 'general', 'key' => $key],
                ['value' => ['value' => $value ?? '']]
            );
        }

        return back()->with('success', 'Global settings saved successfully!');
    }
}
