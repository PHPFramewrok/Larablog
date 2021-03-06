<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use MartinBean\Database\Eloquent\Sluggable;

class Post extends Model {

    use SoftDeletes, Sluggable;
    const DISPLAY_NAME = 'title';

	protected $fillable = ['title', 'content', 'status', 'image', 'allow_comments', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function getPictureAttribute()
    {
        if (empty($this->image)) {
            return '/uploads/'.Setting::first()->banner;
        }
        return '/uploads/'.$this->image;
    }

}
