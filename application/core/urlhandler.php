<?php
namespace Cgi\Application\Core;

class UrlHandler
{
    /**Update url with inputted array of parameters
     * @param $data
     * @param $url
     *
     * @return mixed|string
     */
    public static function updateUrl($data, $url = null)
    {
        if (null === $url) {
            $url = $_SERVER['REQUEST_URI'];
        }
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