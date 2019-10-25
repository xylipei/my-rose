<?php


namespace App\Models;


class Response
{
    static public function error($date = ''){
        $date = [
            'status' => 1,
            'msg' => $date
        ];
        return Response()->json($date);
    }

    static public function success($date = null){
        $dates = [
            'status' => 0,
            'msg' => 'ok'
        ];
        if (empty($date)){
            $dates['result'] = $date;
        }
        return Response()->json($dates);
    }
}