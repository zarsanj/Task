<?php

namespace App\Services;

use App\Http\Classes\Constant;
use Illuminate\Support\Facades\Http;

class SmsService
{
    private string $link, $from, $username, $password;

    public function __construct()
    {
        $this->link = Constant::SMS_LINK;
        $this->from = Constant::SMS_NUMBER;
        $this->username = Constant::SMS_USERNAME;
        $this->password = Constant::SMS_PASSWORD;
    }

    public function send($to, $message)
    {
        $link = $this->link . '?from=' . $this->from . '&to=' . $to . '&username=' . $this->username . '&password=' . $this->password . '&message=' . urlencode($message);
        $response = Http::get($link);
        return $response->getBody();
    }
}
