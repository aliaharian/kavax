<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    use SoftDeletes;

    protected $table = 'service_request';
    protected $fillable = [
        'project_name',
        'full_name',
        'email',
        'phone',
        'service_type',
        'request_meta',
        'status',
    ];
    public $timestamps = true;
    protected $date = ['deleted_at'];
}
