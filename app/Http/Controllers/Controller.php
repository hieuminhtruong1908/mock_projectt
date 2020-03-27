<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showMessage($type, $title, $message)
    {

        return Alert::$type('<p style="color: red;font-size: 18px;position: absolute;top: -15px;">' . "$title" . '</p>',
            '<p style="color: black">' . "$message" . '<p>')->toToast()
            ->showConfirmButton()->toHtml()->background('#fff');
    }

}
