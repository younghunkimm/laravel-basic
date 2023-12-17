<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [ // 화이트리스트 방식
        'body',
        'user_id'
    ];
    
    // protected $guarded = ['id']; // 블랙리스트 방식
}
