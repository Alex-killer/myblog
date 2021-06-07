<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() // проверяет авторизован пользователь или нет
    {
        return true; // пока нет авторизации
        // return auth()->check(); // в дальнейшем поменять на это
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() // правила
    {
        return [
            'title'         => 'required|min:5|max:200', // required - это значит что должно быть обязательно, т.е. без title бдует ошибка
            'slug'          => 'max:200',
            'description'   => 'string|max:500|min:3',
            'parent_id'     => 'required|integer|exists:blog_categories,id', // exists:blog_categories,id - проверка в таблице, должен быть id'
        ];
    }
}
