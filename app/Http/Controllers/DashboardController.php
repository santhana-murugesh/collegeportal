<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Enquiry;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return $this->adminDashboard();
        } elseif (auth()->user()->isStaff()) {
            return $this->staffDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $totalNews = News::count();
        $publishedNews = News::where('is_published', true)->count();
        $pendingEnquiries = Enquiry::where('status', 'pending')->count();
        $totalEnquiries = Enquiry::count();
        $recentNews = News::with(['category', 'user'])->latest()->take(5)->get();
        $recentEnquiries = Enquiry::latest()->take(5)->get();
        
        // User statistics
        $studentCount = User::where('role', 'student')->count();
        $adminCount = User::where('role', 'admin')->count();
        $staffCount = User::where('role', 'staff')->count();
        
        // Analytics data
        $newsByCategory = Category::withCount('news')->get();
        $enquiriesByStatus = [
            'pending' => Enquiry::where('status', 'pending')->count(),
            'in_progress' => Enquiry::where('status', 'in_progress')->count(),
            'resolved' => Enquiry::where('status', 'resolved')->count(),
        ];

        return view('dashboard.admin', compact(
            'totalNews',
            'publishedNews',
            'pendingEnquiries',
            'totalEnquiries',
            'recentNews',
            'recentEnquiries',
            'newsByCategory',
            'enquiriesByStatus',
            'studentCount',
            'adminCount',
            'staffCount'
        ));
    }

    private function staffDashboard()
    {
        $totalNews = News::count();
        $publishedNews = News::where('is_published', true)->count();
        $pendingEnquiries = Enquiry::where('status', 'pending')->count();
        $totalEnquiries = Enquiry::count();
        $recentNews = News::with(['category', 'user'])->latest()->take(5)->get();
        $recentEnquiries = Enquiry::latest()->take(5)->get();
        
        // Analytics data
        $newsByCategory = Category::withCount('news')->get();
        $enquiriesByStatus = [
            'pending' => Enquiry::where('status', 'pending')->count(),
            'in_progress' => Enquiry::where('status', 'in_progress')->count(),
            'resolved' => Enquiry::where('status', 'resolved')->count(),
        ];

        return view('dashboard.staff', compact(
            'totalNews',
            'publishedNews',
            'pendingEnquiries',
            'totalEnquiries',
            'recentNews',
            'recentEnquiries',
            'newsByCategory',
            'enquiriesByStatus'
        ));
    }

    private function studentDashboard()
    {
        $publishedNews = News::published()->with(['category', 'user'])->latest()->paginate(10);
        $categories = Category::active()->withCount(['news' => function($query) {
            $query->published();
        }])->get();
        $myEnquiries = auth()->user()->enquiries()->latest()->take(5)->get();

        return view('dashboard.student', compact('publishedNews', 'categories', 'myEnquiries'));
    }

    public function filterNews(Request $request)
    {
        $query = News::published()->with(['category', 'user']);

        if ($request->category_id) {
            $query->byCategory($request->category_id);
        }

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        $news = $query->latest()->paginate(10);
        $categories = Category::active()->get();

        return view('news.filtered', compact('news', 'categories'));
    }
} 