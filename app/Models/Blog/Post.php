<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable // массив тех полей которые функция fill может заполнить (сделано для того чтобы хакеры через поля не могли бы передать всякие скрипты перезаписываемые)
        = [
            'title',
            'slug',
            'category_id',
            'description',
            'text',
        ];
}
