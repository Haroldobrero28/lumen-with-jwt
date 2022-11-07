<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{

    protected ?Authenticatable $authUser;


    public function __construct()
    {

        $this->authUser = auth()->user();

    }


}
