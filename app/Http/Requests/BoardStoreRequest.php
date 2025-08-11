<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardStoreRequest extends FormRequest {
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return ['name'=>'required|string|min:2|max:100','members'=>'array','members.*'=>'integer'];
    }
}
