<?php

namespace App\Model;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherPages extends Model
{
    use SoftDeletes;
    use Sluggable;

    /* Relationship to User */
    public function user_tbl() {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    use SoftDeletes;

    protected $table = 'other_pages';
    protected $fillable = [
        'title',
        'slug',
        'heading_text',
        'excerpt',
        'status',
        'uid',
        'content_text',
        'template',
        'thumbnail',
        'page_meta'
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
