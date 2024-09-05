<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'integer',
            'filters' => [array('array')],
            'sort_by' => 'string',
            'searchQuery' => 'string',
            'sort_direction' => 'in:asc,desc',
            'per_page' => 'integer',
        ];
    }
}
