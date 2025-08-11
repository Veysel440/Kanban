<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListStoreRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return [
            'board_id'=>'required|string',
            'title'=>'required|string|min:2|max:100',
            'order'=>'nullable|numeric'
        ];
    }
}
