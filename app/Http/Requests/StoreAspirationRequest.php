<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspirationRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required',
            'date'        => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'location'    => 'required',
            'description' => 'required',
            'image'       => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama pengaduan wajib diisi',
            'date.required'        => 'Tanggal wajib diisi',
            'category_id.required' => 'Kategori wajib dipilih',
            'location.required'    => 'Lokasi wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'image.required'       => 'Bukti gambar wajib diupload',
        ];
    }
}
