<?php

class Flasher
{

    public static function setFlash($message, $text, $icon)
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'text' => $text,
            'icon' => $icon
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo 'Swal.fire({
                title: "' . $_SESSION['flash']['message'] . '",
                text: "' . $_SESSION['flash']['text'] . '",
                icon: "' . $_SESSION['flash']['icon'] . '"
            })';            

            unset($_SESSION['flash']);
        }
    }
}