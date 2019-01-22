<?php

namespace App\Exceptions;

use Exception;

class MovieRightsException extends Exception
{
    public function render(){

        return ['error' => 'You do not have the rights to edit or delete this movie'];
    }
}
