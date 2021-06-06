@php
    /** @var \App\Models|Article $item */
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
                            <label for="category_id">Категория</label>
                            <select class="form-select" name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{ $categoryOption->id }}. {{ $categoryOption->title }}
                                        {{--{{ $categoryOption->id_title }}--}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt"
                                      id="excerpt"
                                      class="form-control"
                                      rows="3">{{ old('excerpt', $item->excerpt) }} {{-- item - как сохранить, description - что сохранить передается из контроллера categorycontroller, функции update с помощью хелперской функции old, мы говорим какой ключ мы ищем ('description') в старом инпуте, если он рпидет, $item->description - если старый  description не пришел, тогда берем из записи которая в БД --}}
                            </textarea>

                        <div class="form-group">
                            <label for="content_raw">Текст</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      class="form-control"
                                      rows="10">{{ old('content_raw', $item->content_raw) }} {{-- content_raw - что сохранить, передается из контроллера categorycontroller функции update. С помощью хелперской функции old, мы говорим какой ключ мы ищем ('content_raw') т.е. то что вводили при редактирование записи, то возвращаем этот же текст, если ничего не вводили или с ошибками, то  берем из записи которая в БД $item->content_raw --}}
                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
