@extends('admin.layouts.app')


@section('page_title') Изменение раздела @endsection


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

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success')}}
            </div>
        @endif

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
            <h3 class="card-title">Изменение раздела</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.section.update') }}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id" value="{{ $section->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $section->title }}" placeholder="Заголовок поста">
                    </div>
                    <div class="form-group">
                        <label for="title">Описание</label>
                        <textarea id="summernote" class="summernote" name="content" style="display: none;">{{ $section->content }}</textarea>
                    </div>
                    
                    @if($section->image)
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('storage/'.$section->image) }}" alt="Section image" style="max-width: 100%">
                            </div>
                        </div>
                    @endif

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
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
            </form>
        </div>

    </div>
</div>
            

@endsection