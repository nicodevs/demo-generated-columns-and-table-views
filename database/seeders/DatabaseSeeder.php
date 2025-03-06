<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Item;
use App\Models\Player;
use App\Models\BarProduct;
use App\Models\FooProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        FooProduct::factory(20)->create();
        BarProduct::factory(20)->create();

        $teams = Team::factory(100)->create();
        $players = Player::factory(1000)->recycle($teams)->create();

        for ($i = 0; $i < 52; $i++) {
            $dateString = now()->subWeek($i)->format('Y-m-d H:i:s');

            $items = Item::factory(10_000)->recycle($players)->make()->map(function ($item) use ($dateString) {
                return [...$item->toArray(), 'created_at' => $dateString, 'updated_at' => $dateString];
            })->toArray();

            Item::insert($items);
        }
    }
}
