<?php

    /**
     * Главный ининциализатор
     *
     * @author Zmi
     */


    new Php(); // Настройка php и включение слежки за ошибками
    header('Content-type: text/html; charset=' . $g_config['charset']);

    GetQuery(); // Что бы определился язык сайта

    // Подключаем все языковые файлы из папки /core/lang/нужный язык/
    $dir   = BASEPATH . 'core/lang/' . LANG . '/';
    $files = array_merge(array($dir . 'main.php'), glob($dir . "*.php"));
    foreach ($files as $f)
    {
        if (is_readable($f))
        {
            require_once $f;
        }
    }
?>