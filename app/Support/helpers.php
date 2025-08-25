<?php

use App\Models\Product;

if (! function_exists('generateProductCode')) {
    function generateProductCode(): string
    {
        do {
            $code = sprintf('PRD-%s-%04d', now()->format('Y'), random_int(0, 9999));
        } while (Product::where('code', $code)->exists());

        return $code;
    }
}
