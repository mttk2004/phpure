<?php

namespace Core;

class Form
{
    /**
     * Create a CSRF token
     */
    public static function token(): string
    {
        $token = bin2hex(random_bytes(32));
        Session::set('csrf_token', $token);

        return $token;
    }

    /**
     * Validate a CSRF token
     */
    public static function validateToken(string $token): bool
    {
        $csrfToken = Session::get('csrf_token');

        return $token === $csrfToken;
    }

    /**
     * Create an input field
     */
    public static function input(string $type, string $name, string $value = '', array $attributes = []): string
    {
        $attrs = '';
        foreach ($attributes as $key => $val) {
            $attrs .= " $key=\"$val\"";
        }

        return "<input type=\"$type\" name=\"$name\" value=\"$value\"$attrs>";
    }
}
