<?php


namespace App\Entity;


class SecureFin
{


    function tokenGen() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//!/:{}()[]*-+_@#';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < 12; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    function serialGen() {
        $permitted_chars = '0123456789';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < 8; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

}