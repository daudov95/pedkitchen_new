@extends('admin.layouts.app')


@section('page_title') Изменение инструментария @endsection


@section('content')

<style>
    .table-action {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-action__btn-edit {
        width: 50px;
    }
    .table-action__btn-delete {
        width: 50px;
        margin-top: 0 !important;
        margin-left: 10px;
    }
</style>

    
<div class="row">
    <div class="col-12">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>
        @endif

        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Изменение инструментария</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.cookbook.diagnostic.update') }}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id" value="{{ $post->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" placeholder="Введите заголовок">
                    </div>

                    <div class="form-group">
                        <label>Категория</label>
                        <select class="form-control" name="category_id">
                            <option value="0">Выберите категорию</option>
                            @if ($categories)
                                @foreach ($categories as $cat)
                                    <option value="{{$cat->id}}" {{ $cat->id == $post->category_id ? 'selected' : ''}} >{{ $cat->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    
                    @if ($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" alt="image" style="max-width: 100%; width: 300px">
                    @endif

                    <div class="form-group">
                        <label for="image">Картинка (Формат: jpg, png)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input id="image" type="file" name="image">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="document">Документ (Формат: pdf, doc)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input id="document" type="file" name="document">
                            </div>
                        </div>
                    </div>

                    @if($post->document)
                        <div class="form-group">
                            <label for="document">Прикрепленный документ: </label>
                            <a href="{{ asset('storage/'.$post->document) }}" target="__blank">Посмотреть</a>
                        </div>
                    @endif


                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
            </form>
        </div>

    </div>
</div>
            

@endsection