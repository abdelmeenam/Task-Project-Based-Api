<?php

namespace App\Http\Requests\Task;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:tasks|max:255',
            'project_id' => [
                'nullable',
                //Rule::exists('projects', 'id')->where(function ($query) {$query->where('creator_id', Auth::id());})
                Rule::in(Auth::user()->memberships->pluck('id')),
            ]
        ];
    }
}