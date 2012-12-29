<?php

    /**
     * Класс для записи в console fireBug'а (ну вообще в консоль ошибок и сообщений)
     *
     * @author Zmi
     */
    class FireBugConsole
    {
        private $code    = '<script type="text/javascript" id="debug">(function(){';
        private $timers  = array();
        private $counter = 0;
        private $vars    = array();

        public function __construct() 
        {
            $this->allow = true;
        }

        /**
         * Вывести все в консоли 
         */
        public function End() 
        {
            $ret = '';
            if ($this->allow)
            {
                if (count($this->vars) > 0)
                {
                    $dump        = 'function dump(a,b){var c="";if(!b)b=0;var d="";for(var j=0;j++<=b;)d+=" ";if(typeof(a)==\'object\'){for(var e in a){var f=a[e];if(typeof(f)==\'object\'){c+=d+"\'"+e+"\' ...\n";c+=dump(f,b+1)}else{c+=d+"\'"+e+"\' => \""+f+"\"\n"}}}return c}';
                    $this->code .= $dump;
                }
                echo $this->code . "})();</script>";
            }
            else
            {
                return NULL;
            }
        }

        /**
         * Группировка
         */
        public function Group($name)
        { 
            $this->code .= "console.group('".$name."');";
            return $this; 
        }

        public function GroupEnd() 
        {
            $this->code .= "console.groupEnd();";
            return $this;
        }
        
        /**
         * Начало запуска таймера
         */
        public function Time($name)
        {
            $mtime = microtime(true);
            $this->timers[$name] = $mtime;
            return $this;
        }

        /**
         * Остановка таймера
         */
        public function TimeEnd($name) 
        {
            $timeStart = $this->timers[$name];
            if ($timeStart)
            {
                $endtime   = microtime(true);
                $totaltime = $endtime - $timeStart;
                $this->info("$name: $totaltime seconds");
                $this->timers[$name] = NULL;
            }
            return $this;
        }

        /**
         * Сообщения в консоль
         */
        private function ConsoleType($msg, $mode) 
        {
            if (is_string($msg))
            {
                $msg = "'$msg'";
            }

            $name = '';
            if (is_array($msg))
            {
                $name        = "o" . ($this->counter++);
                $this->code .= $this->JsHash($msg,$name);
                $this->code .= "console." . $mode . "(dump(" . $name . "));";
            }

            if ( ! $name)
            {
                $this->code .= "console." . $mode . "(" . $msg . ");";
            }
        }

        /**
         * Стандартное сообщение в консоль
         */
        public function Log($msg)
        {
            $this->ConsoleType($msg, "log");
            return $this;
        }

        /**
         * Сообщение об ошибке
         */
        public function Error($msg) 
        {
            $this->ConsoleType($msg, "error");
            return $this;
        }

        /**
         * Сообщение предупреждения
         */
        public function Warning($msg)
        {
            $this->ConsoleType($msg, "warn");
            return $this;
        }

        /**
         * Сообщение со значком инфо
         */
        public function Info($msg)
        {
            $this->ConsoleType($msg, "info");
            return $this;
        }

        /**
         * Посмтроение объекта JS из PHP массива
         */
        private function JsHash($arr, $name, & $code = '')
        {
            if ( ! isset($this->vars[$this->counter]))
            {
                $code .= "var ";
                $this->vars[$this->counter] = true;
            }

            $code .= $name . "={};";

            foreach ($arr as $key => $value)
            {
                $outKey = is_int($key) ? "[{$key}]" : ".$key";

                if (is_array($value))
                {
                    $this->JsHash($value, $name . $outKey, $code);
                    continue;
                }

                $code .= $name . $outKey . "=";

                if (is_string($value))
                {
                    $code .= "'{$value}';";
                }
                elseif ($value === false)
                {
                    $code .= "false;";
                }
                elseif ($value === NULL)
                {
                    $code .= "null;";
                }
                elseif ($value === true)
                {
                    $code .= "true;";
                }
                else
                {
                    $code .= "{$value};";
                } 
            }

            return $code;
        }

        public function __destruct()
        {
            $this->End();
        }
    };
?>