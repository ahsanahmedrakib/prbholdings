<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if (filled($request->input('website'))) {
            return back()->withFragment('contact')->with('success', 'Thank you for reaching out. Our team will contact you shortly.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
            'project_id' => ['nullable', 'integer', 'exists:projects,id'],
        ]);

        ContactMessage::create($validated);

        return back()->withFragment('contact')->with('success', 'Thank you for reaching out. Our team will contact you shortly.');
    }
}
