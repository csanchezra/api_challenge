<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['city', 'musical_genre', 'degrees', 'play_list', 'lat', 'long', 'status']; // cosas que entiende elocuent a guardar
    protected $guarded = ['updated_at', 'created_at']; // cosas que ignora elocuent

}
