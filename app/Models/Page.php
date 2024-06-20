<?php

namespace App\Models;

use App\Events\IndexContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content'];
//     protected static function booted()
// {
//     static::created(function ($page) {
//         event(new IndexContent($page->content, 'page'));
//     });

//     static::updated(function ($page) {
//         event(new IndexContent($page->content, 'page'));
//     });

//     static::deleted(function ($page) {
//         event(new IndexContent($page->content, 'page', true));
//     });
// }
    
}
