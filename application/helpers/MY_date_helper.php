<?php
/*
if ( ! function_exists('date_add')){
     function date_add($givendate,$day=0,$mth=0,$yr=0) {
         $cd = strtotime($givendate);
         return date('Y-m-d', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth,  date('d',$cd)+$day, date('Y',$cd)+$yr));
     }
}
*/


if ( ! function_exists('getformatDateEsToEn')){
    function getformatDateEsToEn($dateString)
    {
        $rs = FALSE;
        if (preg_match("/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/", $dateString)) { // ES
            $dateArray = preg_split('/-/',$dateString);
            $rs = $dateArray[2].'-'.$dateArray[1].'-'.$dateArray[0];
        } elseif (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dateString)) {
            $rs = $dateString;
        }

        return $rs;
    }
}

/**
 * @param String format datetime 'Y-m-d'
 * @return DateTime
 */
if ( ! function_exists('getDatetime')){
    function getDateTime($dateString)
    {
        $array = preg_split('/-/',$dateString);
        $date = new DateTime();
        $date->setDate($array[0], $array[1],$array[2]);

        return $date;
    }
}

/* calcular la diferencia entre dos fechas
if ( ! function_exists('date_diff')){
     function date_diff($start_date,$end_date,$format = 'd'){
         $start_date = strtotime($start_date);
         $end_date = strtotime($end_date);

         switch ($format)
         {
            //seconds
            case "s":
                return floor(($end_date-$start_date));
            //minutes
            case "i":
                 return floor(($end_date-$start_date)/60);
            //hours
            case "h":
                 return floor(($end_date-$start_date)/3600);
            //days
            case "d":
                 return floor(($end_date-$start_date)/86400);
            //months
            case "m":
                 return floor(($end_date-$start_date)/2628000);
            //years
            case "y":
                 return floor(($end_date-$start_date)/31536000);
            //days
            default:
                 return floor(($end_date-$start_date)/86400);
            }
     }
}*/



/* conocer la hora exacta de un determinado timezone
if ( ! function_exists('get_date')){
     function get_date($timezone = 'America/New_York', $full_date_time = false){
           date_default_timezone_set($timezone);
           $date = ($full_date_time) ? date('D,F j, Y, h:i:s A') : date('Y-m-d');
           date_default_timezone_set('UTC');
           return $date;
     }
}
if ( ! function_exists('mysql_to_human')){
     function mysql_to_human($fecha_machine){
          $arrfecha = explode("-",trim($fecha_machine));
          $resultado = $arrfecha[2]."/".$arrfecha[1]."/".$arrfecha[0];
          return $resultado;
     }
}
if ( ! function_exists('human_to_mysql')){
     function human_to_mysql($fecha_human){// 12//05/1979
          $arrfecha = explode("/", trim($fecha_human));
          $resultado = $arrfecha[2]."-".$arrfecha[1]."-".$arrfecha[0];
          return $resultado;
     }
}
if ( ! function_exists('dia_semana')){
    function dia_semana($dia_semana) {
        //$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        //return $dias[date("w", mktime(0, 0, 0, $mes, $dia, $ano))];
         $dia_semana=(int) $dia_semana;
         $dia_sema_textual='';

         switch($dia_semana){
             case 0: $dia_sema_textual='Domingo'; break;
             case 1: $dia_sema_textual='Lunes'; break;
             case 2: $dia_sema_textual='Martes'; break;
             case 3: $dia_sema_textual='Miércoles'; break;
             case 4: $dia_sema_textual='Jueves'; break;
             case 5: $dia_sema_textual='Viernes'; break;
             case 6: $dia_sema_textual='Sabado'; break;
             default : $dia_sema_textual=''; break;
         }
         return $dia_sema_textual;
    }
}
if ( ! function_exists('mes_textual')){
    function mes_textual($mes=0)
    {    $mes=(int) $mes;
         $mes_textual='';

         switch($mes){
             case 1: $mes_textual='Enero'; break;
             case 2: $mes_textual='Febrero'; break;
             case 3: $mes_textual='Marzo'; break;
             case 4: $mes_textual='Abril'; break;
             case 5: $mes_textual='Mayo'; break;
             case 6: $mes_textual='Junio'; break;
             case 7: $mes_textual='Julio'; break;
             case 8: $mes_textual='Agosto'; break;
             case 9: $mes_textual='Setiembre'; break;
             case 10: $mes_textual='Octubre'; break;
             case 11: $mes_textual='Noviembre'; break;
             case 12: $mes_textual='Diciembre'; break;
             default : $mes_textual=''; break;
         }
         return $mes_textual;
    }
}*/

