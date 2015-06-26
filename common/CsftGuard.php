<?php

class CsftGuard {
    private static function storeInSession($key, $value) {
        if (isset($_SESSION)) {
            $_SESSION[$key] = $value;
        }
    }

    private static function unsetSession($key) {
        $_SESSION[$key] = ' ';
        unset($_SESSION[$key]);
    }

    private static function getFromSession($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function generateToken($uniqueFormName) {
        if (function_exists("hash_algos") and in_array("sha512", hash_algos())) {
            $token = hash("sha512", mt_rand(0, mt_getrandmax()));
        } else {
            $token = ' ';
            for ($i = 0; $i < 128; ++$i) {
                $r = mt_rand(0, 35);
                if ($r < 26) {
                    $c = chr(ord('a') + $r);
                } else {
                    $c = chr(ord('0') + $r - 26);
                }
                $token .= $c;
            }
        }

        CsftGuard::storeInSession($uniqueFormName, $token);

        return $token;
    }

    public static function validateToken($uniqueFormName, $tokenValue) {
        $token = CsftGuard::getFromSession($uniqueFormName);

        if ($token === false) {
            return false;
        } elseif ($token === $tokenValue) {
            $result = true;
        } else {
            $result = false;
        }

        CsftGuard::unsetSession($uniqueFormName);

        return $result;
    }
}