<?php

namespace App\Model;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model {
    use SoftDeletes;
    use Sluggable;

    /* Relationship to User */
    public function user_tbl() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    use SoftDeletes;

    protected $table = 'blog';
    protected $fillable = [
        'title',
        'slug',
        'cat',
        'status',
        'author_id',
        'content_text',
        'thumbnail',
        'post_meta'
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
