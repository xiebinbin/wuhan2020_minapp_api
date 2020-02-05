<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasSnowflakePrimary;

class MomentHotel extends Model
{
    use HasSnowflakePrimary;
    protected $fillable = [
        'moment_id',
        'need_isolation',
        'room_number',
        'room_bed',
    ];
    
}
