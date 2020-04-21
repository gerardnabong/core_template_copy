<?php

declare(strict_types=1);

use Exception as GLobalHelperException;

function config_safe(string $key, string $expected_type = 'string')
{
    $value = config($key);
    if ($value === null) {
        throw new GLobalHelperException('config_missing_key');
    }
    $actual_type = gettype($value);
    if ($expected_type !== $actual_type) {
        throw new GLobalHelperException('config_key_wrong_type', [
            'key' => $key,
            'expected_type' => $expected_type,
            'actual_type' => $actual_type,
        ]);
    }
    return $value;
}
