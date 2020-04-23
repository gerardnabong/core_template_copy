<?php

declare(strict_types=1);

use App\Model\Portfolio;

function config_safe(string $key, string $expected_type = 'string')
{
    $value = config($key);
    if ($value === null) {
        throw new Exception('config_missing_key', ['key' => $key]);
    }
    $actual_type = gettype($value);
    if ($expected_type !== $actual_type) {
        throw new Exception('config_key_wrong_type', [
            'key' => $key,
            'expected_type' => $expected_type,
            'actual_type' => $actual_type,
        ]);
    }
    return $value;
}

function getPortfolioApiUrl(): string
{
    return Portfolio::getPortfolio()->getPortfolioApiUrl();
}
