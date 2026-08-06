<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\MenuItem;
use App\Models\SiteSetting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user()?->only('id', 'name', 'email', 'role'),
            ],
            'navigation' => fn () => MenuItem::where('location', 'header')->where('is_published', true)->orderBy('sort_order')->get(['label', 'url', 'target']),
            'site' => function () {
                $defaults = [
                    'site_name' => 'ISCME 2027',
                    'tagline' => 'International Scientific Conference on Management & Engineering',
                    'contact_email' => 'iscme@gaftim.com',
                    'contact_phone' => '',
                    'address' => 'Sofia, Bulgaria',
                    'primary_color' => '#003D6C',
                    'facebook_url' => '',
                    'linkedin_url' => '',
                    'x_url' => '',
                ];

                $stored = SiteSetting::where('group', 'general')->get()
                    ->mapWithKeys(fn ($setting) => [$setting->key => $setting->value['value'] ?? ''])
                    ->all();

                return array_replace($defaults, $stored);
            },
        ];
    }
}
