<?php

namespace App\Model;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;
    use Sluggable;

    /* Relationship to User */
    public function user_tbl() {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    protected $table = 'career';
    protected $fillable = [
        'uid',
        'title',
        'slug',
        'status',
        'location',
        'salary',
        'term',
        'content_text',
        'thumbnail',
        'career_meta',
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
