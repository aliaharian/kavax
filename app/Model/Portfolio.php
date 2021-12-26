<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use SoftDeletes;
    use Sluggable;
    /* Relationship to User */
    public function user_tbl() {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    use SoftDeletes;
    protected $table = 'portfolio';
    protected $fillable = [
        'uid',
        'title',
        'slug',
        'grid',
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
