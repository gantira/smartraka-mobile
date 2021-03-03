<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getMonth()
    {
        return [
            [
                'id' => 1,
                'name' => 'Januari',
            ],
            [
                'id' => 2,
                'name' => 'Februari',
            ],
            [
                'id' => 3,
                'name' => 'Maret',
            ],
            [
                'id' => 4,
                'name' => 'April',
            ],
            [
                'id' => 5,
                'name' => 'Mei',
            ],
            [
                'id' => 6,
                'name' => 'Juni',
            ],
            [
                'id' => 7,
                'name' => 'Juli',
            ],
            [
                'id' => 8,
                'name' => 'Agustus',
            ],
            [
                'id' => 9,
                'name' => 'September',
            ],
            [
                'id' => 10,
                'name' => 'Oktober',
            ],
            [
                'id' => 11,
                'name' => 'November',
            ],
            [
                'id' => 12,
                'name' => 'Desember',
            ],
        ];
    }

    public function getYear()
    {
        return Balance::get('created_at')->groupBy(function ($item, $key) {
            return $item->created_at->format('Y');
        })->map(function ($item, $key) {
            return $key;
        })->flatten();
    }
}
