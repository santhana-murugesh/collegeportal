<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::with('user')->latest()->paginate(10);
        return view('enquiries.index', compact('enquiries'));
    }

    public function create()
    {
        return view('enquiries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->all();
        
        // If user is logged in, associate the enquiry
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        Enquiry::create($data);

        return redirect()->route('enquiries.create')->with('success', 'Enquiry submitted successfully!');
    }

    public function show(Enquiry $enquiry)
    {
        return view('enquiries.show', compact('enquiry'));
    }

    public function updateStatus(Request $request, Enquiry $enquiry)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $enquiry->update(['status' => $request->status]);

        return redirect()->route('enquiries.index')->with('success', 'Enquiry status updated successfully!');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()->route('enquiries.index')->with('success', 'Enquiry deleted successfully!');
    }

    public function myEnquiries()
    {
        $enquiries = auth()->user()->enquiries()->latest()->paginate(10);
        return view('enquiries.my-enquiries', compact('enquiries'));
    }
} 