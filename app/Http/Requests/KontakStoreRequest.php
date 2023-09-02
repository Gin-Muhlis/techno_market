<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontakStoreRequest extends FormRequest
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
            'nama' => ['required', 'max:255', 'string'],
            'pesan' => ['required', 'max:255', 'string'],
            'tanggal' => ['required', 'date'],
        ];
    }
}
