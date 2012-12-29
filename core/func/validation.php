<?php

    /**
     * Функции для валидации данных
     *
     * @author Zmi
     */


    /**
     * Чистить мыло перед отправкой письма
     */
    function PrepareEmail($email)
    {
        return str_replace(array("\n", "\r", "\t"), '', $email);
    }

    /**
     * Проверяет email на правильность
     */
    function IsValidEmail($email)
    {
        if (function_exists('filter_var'))
        {
            $ret = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }
        else
        {
            $ret = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email);
        }
        return $ret;
    }

    /**
     * Очищает телефон от всех символов кроме цифр
     */
    function PhoneFilter($phone)
    {
        return preg_replace("/[^0-9]/", '', $phone);
    }

    /**
     * Проверка телефона на правильность
     */
    function IsValidPhone($phone)
    {
        $phone = PhoneFilter($phone);
        return strlen($phone) > 5;
    }

    /**
     * Проверят является ли url валидным url-ом
     */
    function IsValidUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
?>