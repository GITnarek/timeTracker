<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sysname' => ['required', 'unique'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'integer'],
            'priority' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'start_date' => ['required', 'string'],
            'end_date' => ['required', 'string'],
            'estimated_time' => ['required', 'integer'],
            'spent_time' => ['required', 'integer'],
        ];
    }
}
