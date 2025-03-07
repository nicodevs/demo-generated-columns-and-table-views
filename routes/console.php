<?php

use App\Models\Item;
use App\Models\Player;
use App\Models\BarProduct;
use App\Models\FooProduct;
use Illuminate\Support\Carbon;
use App\Models\TeamLeaderboard;
use Illuminate\Support\Benchmark;
use App\Models\PlayersLeaderboard;
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
    Benchmark::dd([
        'eloquent_player_carbon' => function () {
            return Player::query()
                ->withWhereHas('items', fn($q) =>
                    $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                )
                ->withSum(['items' => fn($q) =>
                    $q->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ], 'gold_coins')
                ->orderByDesc('items_sum_gold_coins')
                ->withCasts([
                    'items_sum_gold_coins' => 'integer',
                ])
                ->get();
        },
        'eloquent_player' => function () {
            return Player::query()
                ->withWhereHas('items', fn($q) =>
                    $q->whereRaw('week = YEARWEEK(NOW(), 3)')
                )
                ->withSum(['items' => fn($q) =>
                    $q->whereRaw('week = YEARWEEK(NOW(), 3)')
                ], 'gold_coins')
                ->orderByDesc('items_sum_gold_coins')
                ->withCasts([
                    'items_sum_gold_coins' => 'integer',
                ])
                ->get();
        },
        'eloquent_item' => function () {
            return Item::with('player.team')
                ->selectRaw('player_id, SUM(gold_coins) as gold_coins')
                ->whereRaw('week = YEARWEEK(NOW(), 3)')
                ->groupBy('player_id')
                ->orderByDesc('gold_coins')
                ->withCasts([
                    'gold_coins' => 'integer',
                ])
                ->get();
        },
        'table_view' => fn () => PlayersLeaderboard::get(),
    ], iterations: 1);
});
