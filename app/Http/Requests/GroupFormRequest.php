<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GroupFormRequest extends Request
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
        $dataId = isset($id) ? ',name,' . $id : '';

        return [
            'name' => 'required|string|max:255|unique:customer_groups' . $dataId,
        ];
    }
}
