<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kra8\Snowflake\HasSnowflakePrimary;

class Favorite extends Model
{
    use HasSnowflakePrimary;
    use SoftDeletes;

    protected $fillable = [
        'moment_id',
        'user_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function moment()
    {
        return $this->belongsTo('App\Models\Moment', 'moment_id');
    }
}
