<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use Inertia\Inertia;
use \App\Models\CourseCategory;
use function App\Http\Helpers\getSetting;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Global settings for the frontend
        $settings = [
            'header_categories' => json_decode(getSetting('header_categories')),
            'currency_symbol' => getSetting('currency_symbol'),
            'address' => getSetting('address'),
            'email' => getSetting('email'),
            'phone' => getSetting('phone'),
            'facebook_link' => getSetting('facebook_link'),
            'youtube_link' => getSetting('youtube_link'),
            'instagram_link' => getSetting('instagram_link'),
            'linkedin_link' => getSetting('linkedin_link'),
            'Skype_link' => getSetting('Skype_link'),
           
        ];

        return array_merge(parent::share($request), [
            // Authentication data
            'auth' => [
                'validStudent' => $request->user('student') ? $request->user('student')->only('id', 'name', 'email') : null,
            ],
            // Ziggy routes
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            // Global settings
            'settings' => $settings,
        ]);
    }


}
