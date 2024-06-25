<?php

// helpers funcions - By Julian Kataleko, June, 17, 2024

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount): string {
        $amount = (float) $amount;
        $currency_symbol = auth()->user()?->business?->currency_symbol ?? '$';
        return $currency_symbol . " " . number_format($amount, 2, ',', '.');
    }
}

if (!function_exists('cleanFormatedMoney')) {
    function cleanFormatedMoney($value) {
        $value = str_replace(['$', ' ', 'R$', 'Kz', 'AKZ'], '', $value);
        $value = str_replace([','], '.', $value);
        return $value;
    }
}