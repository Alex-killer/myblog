<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use SoftDeletes;

    //public $table = 'blog_categories'; это указываем если модель и таблица разных имен, а так все модели использует подключение с базой по умолчанию
    protected $fillable // массив тех полей которые функция fill может заполнить (сделано дял того чтобы хакеры через поля не могли бы передать всякие скрипты перезаписываемые)
        = [
            'title',
            'slug',
            'parent_id',
            'description',
        ];
}
