<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function message($var, $successMssg, $dangerMssg){
        if($var){
            session()->flash('mssg', $successMssg);
            session()->flash('alert', 'alert-success');
        }
        else {
            session()->flash('mssg', $dangerMssg);
            session()->flash('alert', 'alert-danger');
        };
    }

}
