<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;
    use Sluggable;

    /* Relationship to User */
    public function user_tbl() {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    protected $table = 'services';
    protected $fillable = [
        'title',
        'slug',
        'service_level',
        'parent_id',
        'portfolio_id',
        'status',
        'uid',
        'content_text',
        'excerpt',
        'service_includes',
        'technology_list',
        'thumbnail',
        'service_meta'
    ];
    public $timestamps = true;
    protected $date = ['deleted_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }
}
