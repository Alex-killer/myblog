<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable // массив тех полей которые функция fill может заполнить (сделано дял того чтобы хакеры через поля не могли бы передать всякие скрипты перезаписываемые)
        = [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_raw',
        ];

}
