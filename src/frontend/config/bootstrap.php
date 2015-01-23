<?php

// <editor-fold defaultstate="collapsed" desc="Variable-dumping functions." >
/**
 * улучшенная функция var_dump, возвращает подсвеченную строку (с HTML-кодом)
 * @param mixed $var - переменная
 * @return string подсвеченный текст
 */
function dump_str($var) {
    ob_start();
    var_dump($var);
    $v = ob_get_clean();
    $v = highlight_string("<?\n" . $v . '?>', true);
    $v = preg_replace('/=&gt;\s*<br\s*\/>\s*(&nbsp;)+/i', '=&gt;' . "\t" . '&nbsp;', $v);
    $v = '<div style="background-color: #FFFFFF;">' . $v . '</div>';
    return $v;
}

/**
 * улучшенная функция var_dump, выводит подсвеченную строку (с HTML-кодом)
 * @param mixed $var - переменная
 */
function dump($var) {
    @header('Content-Type: text/html; charset=UTF-8');//русский текст пиздит!
    $arg_list = func_get_args();
    foreach ($arg_list as $arg) {
        echo dump_str($arg);
    }
}

/**
 * еще более крутая var_dump, теперь еще и с DIE в конце :)
 * @param mixed $var - переменная
 */
function ddump($var) {
    $arg_list = func_get_args();
    foreach ($arg_list as $arg) {
        dump($arg);
    }

    echo '<pre>';
    debug_print_backtrace();
    echo '</pre>';
    die();
}

function strtolower2($string) {
    $lower = 'abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя';
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ';
    return strtr($string, $upper, $lower);
}

// </editor-fold>

