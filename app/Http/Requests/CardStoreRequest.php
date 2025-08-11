<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardStoreRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return [
            'list_id'=>'required|string',
            'title'=>'required|string|min:1|max:200',
            'desc'=>'nullable|string|max:5000',
            'tags'=>'array','tags.*'=>'string|max:50',
            'assignees'=>'array','assignees.*'=>'integer',
            'due_at'=>'nullable|date',
            'order'=>'nullable|numeric'
        ];
    }
}
