<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to_id' => 'required|integer|exists:users,id',
            'assigned_by_id' => 'required|integer|exists:users,id',
        ];
    }

    public function authorize()
    {
        return auth()->user()->isAdmin();
    }
}
