<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasSnowflakePrimary;

class MomentAttachment extends Model
{
    use HasSnowflakePrimary;
    protected $fillable = [
        'moment_id',
        'url',
    ];
}
