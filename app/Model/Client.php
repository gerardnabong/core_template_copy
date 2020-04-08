<?php

declare(strict_types=1);

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'email_address',
        'lead_id',
        'lead_status_id',
        'login_at',
        'portfolio_id',
        'ssn',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
