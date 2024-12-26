<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Footer;
use Inertia\Inertia;
use App\Http\Requests\FooterRequest;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(FooterRequest $request)
    {
        $data = $request->validated();
        $count = isset($data['pages']) ? count($data['pages']) : 0;
        $data['pages'] = json_encode($data['pages'] ?? []);
        Footer::create($data);
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
        $footer = Footer::find($id);
        if ($footer) {
            $footer->delete();
            return Inertia::location(route('setting.index'));
        }
    }
}
