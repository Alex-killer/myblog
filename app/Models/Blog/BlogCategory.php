<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable // массив тех полей которые функция fill может заполнить (сделано дял того чтобы хакеры через поля не могли бы передать всякие скрипты перезаписываемые)
        = [
            'title',
            'slug',
            'img',
            'category_id',
            'description',
            'text',
        ];
}
