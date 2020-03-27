<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShowMessage extends Controller
{
    //
    public function showMessage($type,$title,$message){
        Alert::$type('<p style="color: red;font-size: 18px;position: absolute;top: -15px;">'."$title".'</p>',
            '<p style="color: black">'."$message".'<p>')->toToast()
            ->showConfirmButton()->toHtml()->background('#fff');
    }
}
