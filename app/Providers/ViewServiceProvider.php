<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Career;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Mengoper data career ke semua view yang memerlukan
        View::composer('*', function ($view) {
            // Ambil data career yang sesuai, bisa berdasarkan ID yang diinginkan
            $career = Career::first(); // Sesuaikan dengan logika yang kamu butuhkan
            $view->with('career', $career);
        });
    }
}

