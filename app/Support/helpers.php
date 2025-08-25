<?php

use Illuminate\Support\Str;

if (!function_exists('generateProductCode')) {
  function generateProductCode(): string
  {
    $year = now()->year;
    $suffix = strtoupper(Str::random(4));
    return "PRD-{$year}-{$suffix}";
  }
}
