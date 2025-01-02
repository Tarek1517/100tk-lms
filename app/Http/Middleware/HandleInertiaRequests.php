<?php

namespace App\Http\Middleware;

use function App\Http\Helpers\getSetting;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
use \App\Models\CourseCategory;
use App\Models\Footer;
use App\Models\Page;

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
        // Fetch home categories from settings
        $categoryIds = json_decode(getSetting('home_categories'));
        $HomeCategories = [];
        if ($categoryIds !== null && count($categoryIds) > 0) {
            $HomeCategories = CourseCategory::whereIn('id', $categoryIds ?? [])
                ->select('id', 'slug', 'image', 'name', 'parent_id', 'subtitle')
                ->with('children:id,name,slug,parent_id,image,subtitle')
                ->orderBy('order_number')
                ->get();
        }

        $HeadercategoryIds = json_decode(getSetting('header_categories'));
        $HeaderCategories = [];
        if ($HeadercategoryIds !== null && count($HeadercategoryIds) > 0) {
            $HeaderCategories = CourseCategory::whereIn('id', $HeadercategoryIds ?? [])
                ->select('id', 'slug', 'image', 'name', 'parent_id', 'subtitle')
                ->with('children:id,name,slug,parent_id,image,subtitle')
                ->orderBy('order_number')
                ->get();
        }

        // Fetch course categories from settings
        $CoursecategoryIds = json_decode(getSetting('course_categories'));
        $CourseCategories = [];
        if ($CoursecategoryIds !== null && count($CoursecategoryIds) > 0) {
            $CourseCategories = CourseCategory::whereIn('id', $CoursecategoryIds ?? [])
                ->with(
                    'course:id,category_id,title,cover_image,price,short_description,description',
                    'course.courseClass'
                )
                ->get();
        }

        $footerColumns = Footer::query()->orderBy('order_number')->get();
        foreach ($footerColumns as $column) {
            $footerPageIds = json_decode($column->pages);
            $footerPages = Page::query()->whereIn('id', $footerPageIds)->select('slug', 'title')->get();
            $column['pages'] = $footerPages;
        }

        // Fetch general settings for the app
        $settings = [
            'home_categories' => $HomeCategories,
            'course_categories' => $CourseCategories,
            'header_categories' => $HeaderCategories,
            'currency_symbol' => getSetting('currency_symbol'),
            'address' => getSetting('address'),
            'email' => getSetting('email'),
            'phone' => getSetting('phone'),
            'facebook_link' => getSetting('facebook_link'),
            'youtube_link' => getSetting('youtube_link'),
            'instagram_link' => getSetting('instagram_link'),
            'linkedin_link' => getSetting('linkedin_link'),
            'Skype_link' => getSetting('Skype_link'),
            'footer_columns' => $footerColumns,
            
        ];

        return array_merge(parent::share($request), [
            // Authenticated student data
            'auth' => [
                'validStudent' => $request->user('student')
                    ? $request->user('student')->only('id', 'name', 'email')
                    : null,
            ],

            // Ziggy routes and location
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],

            // Share settings globally
            'settings' => $settings,
            'home_categories' => $settings['home_categories'],
            'course_categories' => $settings['course_categories'],
        ]);
    }
}
