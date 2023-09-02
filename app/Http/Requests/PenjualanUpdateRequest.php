<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanUpdateRequest extends FormRequest
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
            'no_faktur' => ['required', 'max:255', 'string'],
            'tanggal_faktur' => ['required', 'date'],
            'total_bayar' => ['required', 'numeric'],
            'pelanggan_id' => ['required', 'exists:pelanggans,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
