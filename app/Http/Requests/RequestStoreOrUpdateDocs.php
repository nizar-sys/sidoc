<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreOrUpdateDocs extends FormRequest
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
            'subject' => 'nullable',
            'status' => 'nullable',
            'remark' => 'nullable',
        ];
    }


    public function attributes()
    {
        return [
            'subject' => 'Subjek',
            'status' => 'Status',
            'remark' => 'Komentar',
        ];
    }

    function messages()
    {
        return [
            '*.required' => ':attribute wajib diisi',
        ];
    }
}
