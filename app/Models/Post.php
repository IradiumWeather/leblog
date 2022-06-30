<?php

namespace App\Models;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot(){
        parent::boot();
        self::creating(function($post){
            $post->user()->associate(auth()->user()->id);
            $post->category()->associate(request()->categorie);
        });

        self::updating(function ($post){
            $post->category()->associate(request()->categorie);
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
}
