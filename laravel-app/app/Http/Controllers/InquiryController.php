<?php
namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::all();
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function store(Request $request)
    {
        Inquiry::create($request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'project_id' => 'nullable',
        ]));
        return back()->with('success', 'Inquiry submitted');
    }
}
