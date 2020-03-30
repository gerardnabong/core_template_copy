<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = ['email_address', 'ssn', 'portfolio_id', 'lead_id', 'lead_status_id', 'login_at'];
}
