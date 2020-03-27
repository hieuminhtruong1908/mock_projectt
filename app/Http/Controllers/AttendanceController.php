<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance(Request $request, $idContent)
    {
        $memberAtt = $request->member;
        $membercount = array_count_values($memberAtt);
        $memberPresent = [];
        $memberAbsent = [];
        foreach ($membercount as $key => $value) {
            if ($membercount[$key] == 2) {
                $memberPresent [] = $key;
                continue;
            }
            $memberAbsent [] = $key;
        }

        $memberAll = array_values(array_unique($memberAtt));
        $memberNote = $request->note;
        foreach ($memberAll as $key => $value) {
            $atten = Attendance::updateOrCreate(
                ['content_id' => $idContent, 'member_id' => $value],
                [
                    'status' => in_array($value,
                        $memberPresent) ? Attendance::ATTENDANCE_STATUS_PRESENT : Attendance::ATTENDANCE_STATUS_ABSENT,
                    'note' => $memberNote[$key]
                ]
            );
        }

        return redirect()->back();
    }
}


