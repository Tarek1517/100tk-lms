<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\CourseCategory;
use \App\Models\Setting;
use App\Models\Footer;
use App\Models\Page;
use Symfony\Component\HttpFoundation\Response;
use function App\Http\Helpers\getSetting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $settings = [
            'header_categories' => json_decode(getSetting('header_categories')),
            'pages' => json_decode(getSetting('pages')),
            'home_categories' => json_decode(getSetting('home_categories')),
            'course_categories' => json_decode(getSetting('course_categories')),
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

        $parentCategories = CourseCategory::where('parent_id', 0)->with('children')->orderBy('order_number')
            ->get();

        $allCategories = CourseCategory::with('parent', 'children', 'course')->orderBy('order_number')
            ->get();

            $footerColumns = Footer::query()->orderBy('order_number')->get();
            foreach ($footerColumns as $column) {
                $footerPageIds = json_decode($column->pages);
                $footerPages = Page::query()->whereIn('id', $footerPageIds)->select('slug', 'title')->get();
                $column['pages'] = $footerPages;
            }

        return Inertia::render('Dashboard/Setting/Index', [
            'parentCategories' => $parentCategories,
            'allCategories' => $allCategories,
            'footerColumns' => $footerColumns,
            'settings' => $settings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        foreach ($data as $type => $value) {
            $settings = Setting::where('key', $type)->first();

            if ($settings != null) {
                if ($value != null) {
                    if (gettype($value) == 'array') {
                        $settings->value = json_encode($value);
                    } else {
                        $settings->value = $value;
                    }
                    $settings->save();
                }
            } else {
                if ($value != null) {
                    $settings = new Setting;
                    $settings->key = $type;
                    if (gettype($value) == 'array') {
                        $settings->value = json_encode($value);
                    } else {
                        $settings->value = $value;
                    }
                    $settings->save();
                }
            }
        }

        return Inertia::location(route('setting.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
