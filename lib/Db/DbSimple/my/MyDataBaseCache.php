<?php

    /**
     * Кешер запросов по умолчанию
     *
     * Для кеширования в запросах пишите перед текстом запроса "-- CACHE: 10m\n" (10m - ttl кеша)
     *
     * @author Zmi
     */
    class MyDataBaseCache
    {
        public static function Cache($key, $value)
        {
            static $cache = array();
            if ( ! isset($cache[$key]) && ! is_null($value))
            {
                $cache[$key] = $value;
            }
            return isset($cache[$key]) ? $cache[$key] : NULL;
        }
    };
?>