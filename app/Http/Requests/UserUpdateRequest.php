<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array{
        $id = $this->route('id');

        return [
            'username' => ['sometimes', 'max:100'],
            'password' => ['sometimes', 'max:100'],
            'name' => ['sometimes', 'max:100'],
        ];
    }
}
