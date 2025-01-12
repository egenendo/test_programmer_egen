<?php
function currencyFormat($price){
    return number_format($price);
}
if (!function_exists('formatRupiah')) {
    /**
     * Format number to Rupiah currency.
     *
     * @param  int  $number
     * @return string
     */
    function formatRupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
