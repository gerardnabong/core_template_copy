<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    public const LEAD_ID_NEW_CLIENT = 38000;

    protected $fillable = [
        'email_address',
        'lead_id',
        'lead_status_id',
        'login_at',
        'portfolio_id',
        'ssn',
    ];

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }
}
