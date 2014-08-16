<?php
use Laravel\File;
/**
 * Put this in laravels libraries dir and make sure to
 * remove Response in /config/application.php
 * This file will be autoloaded by default.
 * 
 * @author Nico R <lt500r@gmail.com>
 */
class Response1 extends \Laravel\Response
{

    /**
     * Create a response that will force a image to be displayed inline.
     *
     * @param string $path Path to the image
     * @param string $name Filename
     * @param int $lifetime Lifetime in browsers cache
     * @return Response
     */
    public static function inline($path, $name = null, $lifetime = 0)
    {
        if (is_null($name)) {
            $name = basename($path);
        }

        $filetime = filemtime($path);
        $etag = md5($filetime . $path);
        $time = gmdate('r', $filetime);
        $expires = gmdate('r', $filetime + $lifetime);
        $length = filesize($path);

        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $name . '"',
            'Last-Modified' => $time,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $expires,
            'Pragma' => 'public',
            'Etag' => $etag,
        );

        $headerTest1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $time;
        $headerTest2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag;
        if ($headerTest1 || $headerTest2) { //image is cached by the browser, we dont need to send it again
            return static::make('', 304, $headers);
        }

        $headers = array_merge($headers, array(
            'Content-Type' => File::mime(File::extension($path)),
            'Content-Length' => $length,
                ));

        return static::make(File::get($path), 200, $headers);

    }

}