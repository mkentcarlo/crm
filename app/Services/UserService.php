<?php

namespace App\Services;

use App\Notifications\SendEmailUser;

class UserService  
{
	 /**
     * Function that will let user receive an email notification
     *
     * @param object $user information of the user
     * @param object $data details that will be need in email
     *
     * @return int|mixed
     */
    public static function sendEmailUser($user, $data, $subject)
    {
        try {
            $user->notify(new SendEmailUser($data, $subject));
        } catch (\Exception $e) {
            return $e->getCode();
        }
    }
}	