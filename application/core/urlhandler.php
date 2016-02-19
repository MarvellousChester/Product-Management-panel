<?php
namespace Cgi\Application\Core;

class UrlHandler
{
    public static function updateUrl($data)
    {
        $url = $_SERVER['REQUEST_URI'];
        if(strpos($url, '?') == false) {
            $url .= '?';
        }
        foreach($data as $key => $value) {
            if(strpos($url, $key) == false) {
                $url = $url . '&' . $key . '=' . $value;
            }
            else {
                $pattern = '#' . $key . '[^&]+#';
                $url = preg_replace($pattern, "$key=$value", $url);
            }
        }
        return $url;
    }
}