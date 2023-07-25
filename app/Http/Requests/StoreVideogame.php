<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideogame extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name'=>'required|min:5|max:10'
        ];
    }

    public function attributes()
    {
        return[
            'name' => 'videogame name',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre del videojuego no puedes estar vacio.',
        ];
    }
}
