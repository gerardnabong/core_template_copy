<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Cache;

class Client extends Model
{
    public const CLIENT_STATUS_NEW_CLIENT = 38000;
    public const CLIENT_CACHE_KEY = 'client';
    private const CLIENT_CACHE_TIME_HOURS = 1;

    protected $guarded = ['id'];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public static function getHashClient(String $hash): Client
    {
        return Cache::get(self::CLIENT_CACHE_KEY . $hash);
    }

    public static function setHashClient(Client $client)
    {
        $hash = Hash::make($client->id);
        Cache::put(self::CLIENT_CACHE_KEY . $hash, $client, Carbon::now()->addHour(self::CLIENT_CACHE_TIME_HOURS));
        return $hash;
    }


    public static function logout(Int $clientHash)
    {
        Cache::forget(self::CLIENT_CACHE_KEY . $clientHash);
    }
}
