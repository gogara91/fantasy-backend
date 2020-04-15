<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameEventsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stats.*.stat_type_id' => 'required|integer',
            'stats.*.game_id' => 'required|integer',
            'stats.*.player_id' => 'required|integer',
            'stats.*.value' => 'required|integer',
        ];
    }
}
