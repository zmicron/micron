<?php

    /**
     * Базовая конфигурация системы
     *
     * @author Zmi
     */


    // Режим дебага должен быть выключен на продакшен-сервере
    define('DEBUG_MODE', (bool)(strpos($_SERVER["REMOTE_ADDR"], "127.0.0.") === 0 || strpos($_SERVER["REMOTE_ADDR"], "192.168.0.") === 0));

    // Если сайт работает в каталоге напишите здесь каталог пример "cabinet" или "book/php"
    define('SITE_IN_DIR', '');

    // Массив языков сайта
    $g_arrLangs = array(
                            'en' => array('name' => 'English'),
                            'ru' => array('name' => 'Русский')
                        );

    define('DEF_LANG', 'en');

    $g_config            = array();
    $g_config['mainTpl'] = 'main_template';
    $g_config['charset'] = 'utf-8';

    if ( ! defined("E_DEPRECATED"))
    {
        define("E_DEPRECATED", 8192);
    }
    $g_config['phpIni']  = array
                                (
                                    'error_reporting'    => E_ALL ^ E_DEPRECATED,  // Выдавать все ошибки за исключением нотайсов об устаревшом коде
                                    'display_errors'     => DEBUG_MODE,            // Выводить ли ошибки в браузер
                                    'memory_limit'       => '5M',                  // Максимальное коливество памяти на выполнение скрипта
                                    'max_execution_time' => '15',                  // Максимальное время выполнения скрипта
                                    'max_input_time'     => '15',                  // Время в течении которого скрипту разрешено получать данные
                                    // "upload_max_filesize" и "post_max_size" - Для изменения размера загружаемыз данных (файлов или POST) но задавать нужно через "php.ini | .htaccess | httpd.conf"
                                );
    $g_config['useDebugErrorHook'] = true;
    $g_config['logErrors'] = array
                                (
                                    'repeatTmp'         => BASEPATH . 'tmp/log/unRepeatErrTmp',
                                    'logFile'           => BASEPATH . 'tmp/log/log.txt',
                                    'emailTimeRepeat'   => 3 * 60, // Письмо каждые 3 минуты
                                    'email'             => 'example@example.com', // На этот адрес будут присылаться сообщения об ошибках
                                );

    $g_config['extrapacker']                             = array();
    $g_config['extrapacker']['dir']                      = 'auto_merge_css_js';
    $g_config['extrapacker']['packHtml']                 = false;
    $g_config['extrapacker']['packCss']                  = true;
    $g_config['extrapacker']['packJs']                   = true;
    $g_config['extrapacker']['arrExeptions_js']          = array();
    $g_config['extrapacker']['arrExeptionsNotAdd_js']    = array();
    $g_config['extrapacker']['arrExeptions_css']         = array();
    $g_config['extrapacker']['arrExeptionsNotAdd_css']   = array();
    $g_config['extrapacker']['buffering']                = false; // Включен ли GZIP для склеиных css/js

    $g_config['isLoadInMainTpl']  = true;

    $g_config['useModRewrite']    = is_readable(BASEPATH . '.htaccess');

    // Показывает время началы работы движка (требуется в dev/debug_panel для определения времени работы)
    $g_config['startExecTime']    = microtime(true);

    // Получать ли тайтл автоматически из h1 если не было установлено до этого
    $g_config['autoGetTitle']     = true;

    // Постфикс к тайтлу при его автоматическом получении из h1
    $g_config['autoTitlePostfix'] = '';

    define("DOMAIN_COOKIE", "");

    // Стандартный лог движка (ф-я ToLog())
    $g_config['logPath'] = BASEPATH . 'tmp/log.txt';

    // Список ф-и подготавельщиков вывода контента
    $g_config['prepare_functions']  = array
                                      (
                                        '_PrepareContent' // Стандартная микроновская ф-я редактирования вывода
                                      );
?>