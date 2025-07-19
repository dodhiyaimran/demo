<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // store contact message, e.g. send email or save to database
        return back()->with('success', 'Message received');
    }
}
