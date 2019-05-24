<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerFormRequest extends Request
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
        $id     = $this->input('id');
        $dataId = isset($id) ? ',email,' . $id : '';

        return [
            'email' => 'required|email|max:255|unique:customers' . $dataId,
        ];
    }
}
