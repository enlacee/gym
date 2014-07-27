<?php
if ( ! function_exists('stripHTMLtags')){
    /**
     * Cleanner string of tags html
     * @param string $str
     * @return mixed|string
     */
    function stripHTMLtags($str)
    {
        $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
        $t = htmlentities($t, ENT_QUOTES, "UTF-8");
        return $t;
    }
}