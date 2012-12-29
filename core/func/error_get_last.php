<?php

    // Эмуляция ф-ии возвращающей последнюю ошибку если такой на сервере нет
    if( ! function_exists('error_get_last'))
    {
        set_error_handler
        (
            create_function
            (
                '$errno = NULL, $errstr = NULL, $errfile = NULL, $errline = NULL, $errcontext = NULL',
                '
                    global $__error_get_last_retval__;
                    $__error_get_last_retval__ =
                    array
                    (
                        \'type\'        => $errno,
                        \'message\'     => $errstr,
                        \'file\'        => $errfile,
                        \'line\'        => $errline
                    );
                    return false;
                '
            )
        );

        function error_get_last()
        {
            global $__error_get_last_retval__;

            if( ! isset($__error_get_last_retval__))
            {
                return NULL;
            }
            return $__error_get_last_retval__;
        }
    }
?>
