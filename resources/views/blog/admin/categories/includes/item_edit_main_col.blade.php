@php
    /** @var \App\Models|Category $item */
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
                            <input name="title" value="{{ $item->title }}"
                                   id="title"
                                   type="text"
                                   class="form-control"
                                   minlength="3"
                                   required>
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
                            <select name="parent_id"
                                    id="parent_id"
                                    class="form-control"
                                    placeholder="Выберете категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->parent_id) selected @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
{{--                                        {{ $categoryOption->id_title }}--}}
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
