<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kra8\Snowflake\HasSnowflakePrimary;

class SmsCode extends Model
{
    use HasSnowflakePrimary;
    use SoftDeletes;
    protected $fillable = [
        'phone', 'code', 'expired_at'
    ];
    protected $casts = [
        'expired_atgft v6sa' => 'datetime'
    ];
}
