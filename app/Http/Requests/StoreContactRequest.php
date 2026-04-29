<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat request ini.
     * Dibuka untuk semua (termasuk tamu/pengunjung).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi yang diterapkan ke request ini.
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email:rfc,dns', 'max:100'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    /**
     * Pesan error kustom dalam Bahasa Indonesia.
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'Nama wajib diisi.',
            'name.max'         => 'Nama tidak boleh lebih dari 100 karakter.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'subject.max'      => 'Subjek tidak boleh lebih dari 200 karakter.',
            'message.required' => 'Isi pesan wajib diisi.',
            'message.min'      => 'Pesan minimal 10 karakter.',
            'message.max'      => 'Pesan tidak boleh lebih dari 2000 karakter.',
        ];
    }
}
