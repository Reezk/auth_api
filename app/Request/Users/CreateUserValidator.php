<?php

namespace App\Request\Users;

use App\Request\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        return [
            'name' => 'require|max:50',
            'email' => 'require|min:5|max:50|email|unique:users,email',
            'password' => 'require|min:6|max:50|confirmed',
        ];
    }

    public function authorized(): bool
    {
        return true;
    }
}
