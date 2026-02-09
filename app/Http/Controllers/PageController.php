<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $breadcrumbs = [
            ['title' => 'Главная', 'url' => route('home')],
            ['title' => $page->title, 'url' => null],
        ];

        return view('pages.page', compact('page', 'breadcrumbs'));
    }

    public function delivery()
    {
        $stores = \App\Models\Store::where('is_active', true)
            ->orderBy('city')
            ->orderBy('name')
            ->limit(5)
            ->get();

        return view('pages.delivery', compact('stores'));
    }

    public function payment()
    {
        return view('pages.payment');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
