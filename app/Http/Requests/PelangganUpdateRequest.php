<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nama_pelanggan' => ['required', 'max:255', 'string'],
            'kode_pelanggan' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255', 'string'],
            'no_telp' => ['required', 'max:255', 'string'],
        ];
    }
}
