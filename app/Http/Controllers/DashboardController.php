<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'isVerify' => auth()->user()->hasVerifiedEmail(),
            'news' => News::query()
                ->when($request->input('search'), fn($query, $search) => $query->where('title', 'LIKE', "%{$search}%")->orWhere('description', 'LIKE', "%{$search}%"))
                ->paginate(15)
                ->withQueryString(),
            'query' => $request->input('search')
        ]);
    }
}
