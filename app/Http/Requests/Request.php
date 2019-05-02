<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    /**
     * Throws error if failed
     *
     * @throws Exception
     *
     * @return mixed
     */
    protected function failedAuthorization()
    {
        if (empty($this->error)) {
            $this->error = 'Authorization error';
        }

        return redirect()->back()->withInput()->withErrors($this->error);
    }
}
