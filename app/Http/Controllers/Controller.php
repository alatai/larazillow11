<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \Illuminate\Routing\Controller as RoutingController;

// abstract class Controller
abstract class Controller extends RoutingController
{
    //Laravel 11 $this->authorize() method was deprecated and now you need to use Gate::authorize().
    // Or you need to update Controller class (app\Http\Controllers\Controller.php) with following code:
    use AuthorizesRequests;
}
