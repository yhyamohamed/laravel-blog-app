<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use App\Models\Comment;
use Carbon\Carbon;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;
    use HasTags;


    protected $appends = ['human_readable_date'];
    protected $fillable = ['title', 'description', 'user_id', 'postAvatar','tags'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    protected function getHumanReadableDateAttribute()
    {
        return Carbon::createFromTimeString($this->attributes['created_at'])->toDayDateTimeString();
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    protected function setPostAvatarAttribute($value)
    {
        if ($value) {
            $path = $value->store('images/uploads', ['disk' => 'posts-Avatar']);
            return   $this->attributes['postAvatar'] = $path;
        }
    }
}
