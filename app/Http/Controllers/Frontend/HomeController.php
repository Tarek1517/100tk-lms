<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \App\Models\CourseCategory;
use \App\Models\Course;
use App\Models\Footer;
use App\Models\Page;

use function App\Http\Helpers\getSetting;

class HomeController extends Controller
{
    public function index()
    {

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

        $CoursecategoryIds = json_decode(getSetting('course_categories'));
        $CourseCategories = [];
        if ($CoursecategoryIds !== null && count($CoursecategoryIds) > 0) {
            $CourseCategories = CourseCategory::whereIn('id', $CoursecategoryIds ?? [])
                ->with('course:id,category_id,title,cover_image,price,short_description,description', 'course.courseClass')
                ->get();
        }

        $footerColumns = Footer::query()->orderBy('order_number')->get();
        foreach ($footerColumns as $column) {
            $footerPageIds = json_decode($column->pages);
            $footerPages = Page::query()->whereIn('id', $footerPageIds)->select('slug', 'title')->get();
            $column['pages'] = $footerPages;
        }

        $settings = [
            'header_categories' => $HeaderCategories,
            'home_categories' => $HomeCategories,
            'course_categories' => $CourseCategories,
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


        return Inertia::render('Frontend/Home/Index', [
            'settings' => $settings,
            'home_categories' => $settings['home_categories'],
            'course_categories' => $settings['course_categories'],
        ]);

    }
    public function categoryCourse()
    {
        $AllCourses = Course::with('courseClass')
            ->get();
        return Inertia::render('Frontend/Course/Category', [
            'AllCourses' => $AllCourses,
        ]);


    }
}
