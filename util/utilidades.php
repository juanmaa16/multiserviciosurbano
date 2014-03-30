<?php

class Utilidades {

    public static function convertLinkYouTube($texto) {
        $Pos_Link_Youtube = stripos($texto, "http://www.youtube.com/watch?v=");
        $Enlace_Youtube = substr($texto, $Pos_Link_Youtube + 31, 11);
        $texto = str_ireplace("http://www.youtube.com/watch?v=" . $Enlace_Youtube, '<iframe width="420" height="315" src="http://www.youtube.com/embed/' . $Enlace_Youtube . '" frameborder="0" allowfullscreen></iframe>', $texto);
        return $texto;
    }

    public static function acortaTexto($text, $limite, $char) {
        if (strlen($text) <= $limite) {
            return $text;
        }
        $pos = strripos($text, $char);
        if ($pos === false) {//did not find the $char
            return substr($text, 0, $limite) . " [...]";
        } else {//si lo encontramos, chequeamos que la posicion sea menor al limite
            if ($pos < $limite) {//si lo encontramos todo ok! llegamos donde queriamos (:
                return substr($text, 0, $pos + 1) . " [...]"; //incluimos el char.
            } else {
                //seguimos buscando recursivamente con el string que tenemos recortado
                return Utilidades::acortaTexto(substr($text, 0, $pos), $limite, $char);
            }
        }
        return substr($text, 0, $limite) . " [...]"; //se supone que nunca llegaria aqui (x
    }

    public static function formatero_numero($numero) {
        return number_format($numero, 2, ',', '.');
    }

    public static function db_number($numero) {
        return number_format($numero, 2, '.', ',');
    }

    public static function db_adapta_string($str) {
        return "\"$str\"";
    }

//  sanatize file name
//     - remove extra spaces/convert to _,
//     - remove non 0-9a-Z._- characters,
//     - remove leading/trailing spaces
//  check if under 5MB,
//  check file extension for legal file types
    public static function safeText($text) {
        return preg_replace(
                        array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($text));
    }

    //for text with 
    public static function breakeLines($text) {
        return preg_replace('#(\\\r|\\\n)#', '<br/>', preg_replace('#(\\\r\\\n)#', '<br/>', $text));
    }

    public static function removeBreakLines($text) {
        return preg_replace('#(\\\r|\\\n)#', ' ', preg_replace('#(\\\r\\\n)#', ' ', $text));
    }

    #Example: source from: http://snipplr.com/view/3644/
//    get_date_spanish(time(), true, 'month'); # return Enero
//    get_date_spanish(time(), true, 'month_mini'); # return ENE
//    get_date_spanish(time(), true, 'Y'); # return 2011
//    get_date_spanish(time());#return 06 de septiempre de 2011
    #Modified by Fanky10

    public static function get_date_spanish($time, $part = false, $formatDate = '') {
        #Declare n compatible arrays
        $month = array("", "enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiempre", "diciembre"); #n
        $month_execute = "n"; #format for array month

        $month_mini = array("", "ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "DIC"); #n
        $month_mini_execute = "n"; #format for array month

        $day = array("domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"); #w
        $day_execute = "w";

        $day_mini = array("DOM", "LUN", "MAR", "MIE", "JUE", "VIE", "SAB"); #w
        $day_mini_execute = "w";

        /*
          Other examples:
          Whether it's a leap year
          $leapyear = array("Este año febrero tendrá 28 días"."Si, estamos en un año bisiesto, un día más para trabajar!"); #l
          $leapyear_execute = "L";
         */

        #Content array exception print "HOY", position content the name array. Duplicate value and key for optimization in comparative
        $print_hoy = array("month" => "month", "month_mini" => "month_mini");

        if ($part === false) {
            return date("d", $time) . " de " . $month[date("n", $time)] . " de " . date("Y", $time); // . ", ". date("H:i",$time) ." hs";
        } elseif ($part === true) {
            if (!empty($print_hoy[$formatDate]) && date("d-m-Y", $time) == date("d-m-Y"))
                return "HOY";#Exception HOY
            if (!empty(${$formatDate}) && !empty(${$formatDate}[date(${$formatDate . '_execute'}, $time)]))
                return ${$formatDate}[date(${$formatDate . '_execute'}, $time)];
            else
                return date($formatDate, $time);
        }else {
            return date("d-m-Y H:i", $time);
        }
    }

}

?>
