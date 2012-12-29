<?php

    /**
     * Конфиг работы с БД
     *
     * @author Zmi
     */


    $g_config['dbSimple']                     = array();
    $g_config['dbSimple']['logDbError']       = true;
    $g_config['dbSimple']['dbLogFile']        = BASEPATH . 'tmp/log_db.txt';

    // Имена БД объектов, будут хранится в $g_databases->dbName подключение к БД задается через DSN
    // Работа с БД происходит при помощи DbSimple (http://dklab.ru/lib/DbSimple/)
    $g_config['dbSimple']['databases'] = array
    (
        /* Пример:
        'db' => array
                    (
                        'dsn'        => DEBUG_MODE ? 
                                            'mysql://root:@localhost/DataBaseName?charset=UTF8' : // Если локалка то локальная БД
                                            'mysql://User:Pwd@Host/DataBaseName?charset=UTF8',    // Если сервер то настоящая БД
                        'pCacheFunc' => 'AnyFuncName' // Указатель на функцию кеширования данных например array('MyDataBaseCache', 'Cache')
                    )
        */
        // Тут вписать коннекты
    );
?>