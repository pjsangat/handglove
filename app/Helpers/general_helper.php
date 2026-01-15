<?php

function p($arr = array()){
    print "<pre>";
    print_r($arr);
    print "</pre>";
}

function pe($arr = array()){
    print "<pre>";
    print_r($arr);
    print "</pre>";
    exit();
}

function generate_token($len = 25){
    $dumpdata = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $token = substr(str_shuffle($dumpdata), 0, $len);
    return $token;
}

function generate_url(...$segments){
  $url = base_url();

  $ctr = 0;
  foreach ($segments as $seg) {
    if($ctr > 0){
        $url .= "/";
    }
    $url .= $seg;

    $ctr++;
  }
  return $url;
}
//------------------------------------------------------
function getServerTimestamp(){
  $stamp =  date('Y-m-d H:i:s');
  return $stamp;
}
//------------------------------------------------------
function isValidToken($data, $token, $period=24){
  $date = date(getServerTimestamp());
  $diff = date_diff2($data['token_date'], $date);
  //print_r("Reset  : {$row['token_date']}<br>Server : {$date}<br>Period : {$diff['asString']}");
  $period_second = $period*60*60;
  return ($data['token'] == $token &&
    $data['token_active'] == 1 &&
    $diff['exceeded'] > 0 &&
    $diff['exceeded'] <= $period_second //validation limit $period_second = $period*60*60
  );
}

//------------------------------------------------------
function date_diff2($date1, $date2){
    $diff = strtotime($date2) - strtotime($date1);
    if ($diff <= 0) {
        $asString = "[<br> <b>valid :</b> 0 <br><b>Period : </b>00:00:00:00:00:00<br> Diff : </b>" . strval($diff) . "<br>]";
        $result = array(
            'valid' => 0,
            'year' => 0,
            'month' => 0,
            'days' => 0,
            'hours' => 0,
            'minutes' => 0,
            'seconds' => 0,
            'exceeded' => $diff,
            'asString' => $asString
        );
        return $result;
    }

    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
    $asString = '[ <br> <b>valid :</b> 1 <br><b>Period : </b>' .
        strval($years) . ":" .
        strval($months) . ":" .
        strval($days) . ":" .
        strval($hours) . ":" .
        strval($minutes) . ":" .
        strval($seconds) . "<br> <b>Diff : </b>" .
        strval($diff) . "<br>]";

    $result = array(
        'valid' => 1,
        'year' => $years,
        'month' => $months,
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds,
        'exceeded' => $diff,
        'asString' => $asString
    );
    return $result;
}