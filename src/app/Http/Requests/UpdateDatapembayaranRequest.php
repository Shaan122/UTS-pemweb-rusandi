<?php

namespace App\Http\Requests;

use App\Models\Datapembayaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDatapembayaranRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('datapembayaran_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'no' => [
                'string',
                'nullable',
            ],
            'tanggal' => [
                'nullable',
                'date',           
            ],
            'total' => [
                'nullable',        
            ],
            'status' => [
                'nullable',
                'string',           
            ],
        ];
    }
}
