<?php

    /**
     * Валидатор html кода
     *
     * Сливает head-ы читит плохие символы и немножко валидирует код
     *
     * @author Zmi
     */
    class HtmlValidate
    {
        private $hmtl;

        public function __construct()
        {
            $this->html = '';
        }

        public function Get($html)
        {
            $this->html = $html;

            $this->HeadBodyMerge();
            $this->TagValidate();

            return $this->html;
        }

        /**
         * Валидация html кода
         */
        private function TagValidate()
        {
            $replaces = array
                            (
                                '<br>' => '<br />',
                                '<hr>' => '<hr />'
                            );
            $this->html = strtr($this->html, $replaces);
        }

        /**
         * Сливает несколько разделов head в 1
         */
        private function HeadBodyMerge()
        {
            preg_match_all("~<head(.*?)>(.*?)</head>~is", $this->html, $m);

            // Если вообще есть <head>...</head>
            if ( ! empty($m))
            {
                // Если <head>...</head> больше чем 1 тогда имеет смысл их объединять
                if (count($m[0]) > 1)
                {
                    // Собираем общий head
                    $mergeHead = "<head" . $m[1][0] . ">" . implode('', array_filter(array_unique($m[2]))) . "</head>";

                    // Заменяем все <head>...</head> на 1 слитый
                    $this->html = str_replace($m[0][0], $mergeHead, $this->html);
                    $this->html = str_replace(array_splice($m[0], 1), '', $this->html);
                }
            }
        }
    };
?>