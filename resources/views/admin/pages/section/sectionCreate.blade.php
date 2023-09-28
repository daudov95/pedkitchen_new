@extends('admin.layouts.app')


@section('page_title') Создание нового раздела @endsection


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

        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Создание нового раздела</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.section.create') }}" enctype="multipart/form-data">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Заголовок поста">
                    </div>
                    <div class="form-group">
                        <label for="title">Описание</label>
                        {{-- <textarea name="content" class="form-control" rows="3" placeholder="Пишите...">{{ old('content') }}</textarea> --}}
                        <textarea id="summernote" class="summernote" name="content" style="display: none;">{{ old('content') }}</textarea>
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputFile">Картинка (Формат: jpg, png)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input type="file" name="image">
                            </div>
                        </div>
                    </div>

                    
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>

    </div>
</div>
            

@endsection