<?php

namespace App\Components;

class HtmlComponent
{
    /**
     * @param $email
     * @return null
     */
    public function filterEmail($email)
    {
        $email = $this->filterString($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        } else {
            return null;
        }
    }

    /**
     * @param $string
     * @param int $minLength
     * @return null
     */
    public function filterString($string, $minLength = 2)
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_STRING));
        if (mb_strlen($string) > (int)$minLength) {
            return $string;
        } else {
            return null;
        }
    }

    /**
     * @param $string
     * @return mixed
     */
    public function encode($string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
