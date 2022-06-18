<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateDocsDetail extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'document_id' => 'required|exists:documents,id',
            'nama_nasabah' => 'required',
            'amount' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nama_nasabah' => 'Nama Nasabah',
            'amount' => 'Jumlah',
            'document_id' => 'Dokumen'
        ];
    }

    function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
        ];
    }
}
