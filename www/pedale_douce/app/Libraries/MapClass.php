<?php

namespace App\Libraries;

use Config\Services;

class MapClass {

    public static function generate($stations) {

        $session = Services::session();
        $userinfo = $session->get("userinfo");
        $userId = $userinfo["uid"];
        $posX = $userinfo["coor_x"];
        $posY = $userinfo["coor_y"];

        //* Create background from source file
        $srcFile = "./assets/map_bg.png";
        $image = ImageCreateFromPng ($srcFile);

        //* Colors allocation
        // $col_red = imagecolorallocate($image, 255, 0, 0);
        $col_red = imagecolorallocate($image, 240, 64, 64);  //@ #F04040
        // $col_green = imagecolorallocate($image, 0, 255, 0);
        $col_green = imagecolorallocate($image, 64, 192, 64);  //@ #40C040
        // $col_blue = imagecolorallocate($image, 0, 0, 255);
        $col_blue = imagecolorallocate($image, 0, 128, 255);  //@ #0080FF
        // $col_yellow = imagecolorallocate($image, 255, 255, 0);
        $col_yellow = imagecolorallocate($image, 160, 160, 32);  //@ #A0A020
        // $col_black = imagecolorallocate($image, 0, 0, 0);
        $col_black = imagecolorallocate($image, 0, 0, 0);  //@ #000000
        // $col_white = imagecolorallocate($image, 255, 255, 255);
        $col_white = imagecolorallocate($image, 255, 255, 255);  //@ FFFFFF

        //* Gfx Configurations
        $fontType = './fonts/courier-new-bold.ttf';  //* True Type Font
        $fontSize = 20;  //* Font size
        $PointSize = 40;  //* Point size

        //* User placement
        imagefilledellipse($image, $posX, $posY, $PointSize, $PointSize, $col_yellow);

        //* Stations placement
        foreach ($stations as $station) {

            //* Choose color from station 'stat' value
            switch ($station["stat"]) {
                case 0:
                    $color = $col_green;
                    break;
                case 1:
                    $color = $col_blue;
                    break;
                case 2:
                    $color = $col_red;
                    break;
                default:
                    $color = $col_black;
            }

            //* Get station info
            $x = $station["coor_x"];
            $y = $station["coor_y"];
            $txt = $station["uid"];

            //* Create circle
            imagefilledellipse($image, $x, $y, $PointSize, $PointSize, $color);
    
            //* Create text
            $pts = imagettfbbox($fontSize, 0, $fontType, $txt);  //* Get text box points
            $w = $pts[4] - $pts[0];  //* Text width
            $h = $pts[1] - $pts[5];  //* Text height
            $hw = intval($w / 2);  //* Half width
            $hh = intval($h / 2);  //* Half height
            imagettftext($image, $fontSize, 0, ($x - $hw - 2), ($y + $hh), $col_black, $fontType, $txt);
        }

        $trgFile = "./maps/map_" . $userId . ".png";  //* Create target file path
        imagepng($image, $trgFile);  //* Generate file
        imagedestroy($image);  //* Frees memory

        return $trgFile;  //* Return generated file name
    }
}
