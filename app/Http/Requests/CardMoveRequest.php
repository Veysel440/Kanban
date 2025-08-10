<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardMoveRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return [
            'to_list_id'=>'required|string',
            'before_order'=>'nullable|numeric',
            'after_order'=>'nullable|numeric',
        ];
    }
}
