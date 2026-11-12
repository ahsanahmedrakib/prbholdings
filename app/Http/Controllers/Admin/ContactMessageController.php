<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter');

        $messages = ContactMessage::query()
            ->with('project')
            ->when($filter === 'unread', fn ($query) => $query->where('is_read', false))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.messages.index', compact('messages', 'filter', 'unreadCount'));
    }

    public function show(ContactMessage $message): View
    {
        $message->load('project');

        if (! $message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Enquiry deleted successfully.');
    }
}