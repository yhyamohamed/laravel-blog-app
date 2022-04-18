<?php

namespace App\Rules;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class PostsCount implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        return User::find($value)->post->count() <3;
    }

  
    public function message()
    {
        return 'sry you ve exceeded your post limit';
    }
}
