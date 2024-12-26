<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;
use \App\Models\Page;

class PageControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $Allpages = Page::orderBy('created_at', 'DESC')->get();

        return Inertia::render('Dashboard/Page/Index', [
            'Allpages' => $Allpages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Dashboard/Page/Add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['title']);
        Page::create($data);

        return Inertia::location(route('page.index'));
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
        $editPage = Page::findOrFail($id);

        return Inertia::render('Dashboard/Page/Edit', [
            'editPage' => $editPage,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, string $id)
    {
        $page = Page::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $page->update($data);
        return Inertia::location(route('page.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pageDelete = Page::find($id);
        if ($pageDelete) {
            $pageDelete->delete();
            return Inertia::location(route('page.index'));
        }
    }
}
