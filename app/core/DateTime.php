<?php

namespace App\Core;

use DateTimeZone;

class DateTime
{
    /**
     * Converts current time for given timezone (considering DST)
     *  to 14-digit UTC timestamp (YYYYMMDDHHMMSS)
     *
     * @param $userTimezone
     * @param string $serverTimezone
     * @param string $serverDateFormat
     * @return string
     */
    public function now($userTimezone,
                        $serverTimezone = CONST_SERVER_TIMEZONE,
                        $serverDateFormat = CONST_SERVER_DATEFORMAT)
    {

        // set timezone to user timezone
        date_default_timezone_set($userTimezone);

        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone($serverTimezone));
        $str_server_now = $date->format($serverDateFormat);

        // return timezone to server default
        date_default_timezone_set($serverTimezone);

        return $str_server_now;
    }
}