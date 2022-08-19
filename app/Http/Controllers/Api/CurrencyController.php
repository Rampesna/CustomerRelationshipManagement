<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    public function getAll()
    {
        return [
            'TRY' => 'Türk Lirası',
            'USD' => 'Dolar',
            'EUR' => 'Euro',
            'GBP' => 'Sterlin',
        ];
    }
}
