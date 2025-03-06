<?php

use App\Models\Clan;
use App\Models\Invoice;
use App\Models\BarProduct;
use App\Models\FooProduct;
use Illuminate\Support\Carbon;
use App\Models\TeamLeaderboard;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Artisan;

Artisan::command('demo:products', function () {
    Benchmark::dd([
        'foo' => fn () => FooProduct::get(),
        'bar' => fn () => BarProduct::get(),
    ], iterations: 10);

    Benchmark::dd([
        'foo' => fn () => FooProduct::get()->where('final_price', '>', 100)->count(),
        'bar' => fn () => BarProduct::where('final_price', '>', 100)->count(),
    ], iterations: 10);
});

Artisan::command('demo:leaderboard', function () {
    $teamLeaderboard = TeamLeaderboard::get();
});
