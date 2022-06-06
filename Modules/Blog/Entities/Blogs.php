<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blogs extends Model
{
    use HasFactory;

    protected $table = "blogs";

    protected $fillable = ['judul', 'isi', 'penulis'];
    
    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogsFactory::new();
    }
}
