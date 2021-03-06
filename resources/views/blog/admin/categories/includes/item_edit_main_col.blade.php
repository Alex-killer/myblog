@php
    /** @var \App\Models|BlogCategory $item */
    /** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input name="title" value="{{ $item->title }}" {{-- name="title - имя должно дублировать имя столбца в таблице --}}
                                   id="title" {{-- нужен для того чтобы привязался <label for="title">Заголовок</label> --}}
                                   type="text"
                                   class="form-control"
                                   minlength="3" {{-- минимальная длина --}}
                                   required> {{-- обязательное поле должно заполняться --}}
                        </div>

                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input name="slug" value="{{ $item->slug }}"
                                   id="slug"
                                   type="text"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="parent_id">Родитель</label>
                            <select class="form-select" name="parent_id"
                                    id="parent_id"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}" {{-- идентификатор категории --}}
                                            @if($categoryOption->id == $item->parent_id) selected @endif> {{-- если идентификатор категории равен parent_id текущего элемента--}}
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }} {{-- выводим id. имя --}}
                                        {{-- {{ $categoryOption->id_title }}--}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control"
                                      rows="3">{{ old('description', $item->description) }} {{-- item - как сохранить, description - что сохранить передается из контроллера categorycontroller, функции update с помощью хелперской функции old, мы говорим какой ключ мы ищем ('description') в старом инпуте, если он рпидет, $item->description - если старый  description не пришел, тогда берем из записи которая в БД --}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
