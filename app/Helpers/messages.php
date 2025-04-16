<?php

if (!function_exists('setFlashMessage')) {
    function setFlashMessage(string $message, string $status = 'Success'): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['response'] = [
            'Message' => $message,
            'Status'  => $status,
        ];
    }
}

if (!function_exists('getFlashMessage')) {
    function getFlashMessage(): ?array
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (isset($_SESSION['response'])) {
            $response = $_SESSION['response'];
            unset($_SESSION['response']);
            return $response;
        }

        return null;
    }
}
