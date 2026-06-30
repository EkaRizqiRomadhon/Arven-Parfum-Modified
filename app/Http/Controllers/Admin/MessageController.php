<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = ContactMessage::where('status', 'unread')->count();
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        // Auto-tandai baca saat dibuka
        if ($message->status === 'unread') {
            $message->update(['status' => 'read']);
        }
        return view('admin.messages.show', compact('message'));
    }

    public function markRead($id)
    {
        ContactMessage::findOrFail($id)->update(['status' => 'read']);
        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
