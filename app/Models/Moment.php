<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kra8\Snowflake\HasSnowflakePrimary;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moment extends Model
{
    use HasSnowflakePrimary;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'cover_url',
        'cate',
        'type',
        'resource',
        'resource_remark',
        'province',
        'city',
        'address_detail',
        'important_information',
        'information'
    ];
    
    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function hotel()
    {
        return $this->belongsTo('App\Models\MomentHotel', 'moment_id');
    }
    public function express()
    {
        return $this->belongsTo('App\Models\MomentExpress', 'moment_id');
    }
    public function attachments(){
        return $this->hasMany('App\Models\MomentAttachment', 'moment_id');
    }
    public function peoples(){
        return $this->hasMany('App\Models\MomentPeople', 'moment_id');
    }
}
