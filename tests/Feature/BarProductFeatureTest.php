<?php

use App\Models\BarProduct;

test('calculates final price', function () {
    $product = BarProduct::factory()->create([
        'base_price' => 100,
        'tax_rate' => 10,
    ]);
    $product->refresh(); // 💡 TIP: Refresh the model

    expect($product->final_price)->toBe(110.00);
});
