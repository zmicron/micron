<?php

    /**
     * Пакер HTML котента
     *
     * @author Zmi
     */
    class HtmlPacker
    {
        public static function Pack($s)
        {
            $s = trim($s);
            $s = strtr($s, array("\r" => '', "\t" => ' '));
            $s = preg_replace("/\s{3,}/i", "\n", $s);
            return $s;
        }
    };
?>