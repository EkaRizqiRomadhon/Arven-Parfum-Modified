<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(private readonly ContactService $contactService) {}

    /**
     * Simpan pesan kontak dari pengunjung.
     * Validasi ditangani oleh StoreContactRequest.
     * Logika bisnis ditangani oleh ContactService.
     */
    public function store(StoreContactRequest $request)
    {
        $this->contactService->storeAndNotify(
            data: $request->validated(),
            ip:   $request->ip(),
        );

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera dibalas.');
    }
}
