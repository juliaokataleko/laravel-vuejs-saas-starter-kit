<?php

// helpers funcions - By Julian Kataleko, June, 17, 2024

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount): string {
        $amount = (float) $amount;

        $currency_symbol = auth()->user()?->company?->currency_symbol ?? 'Kz';

        return $currency_symbol . " " . number_format($amount, 2, ',', '.');
    }
}