<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['human_readable_date'];
    protected $fillable= ['title','description','user_id'];

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
}
