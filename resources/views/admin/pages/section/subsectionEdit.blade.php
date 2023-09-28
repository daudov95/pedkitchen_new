@extends('admin.layouts.app')


@section('page_title') Изменение подраздела @endsection


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
            <h3 class="card-title">Изменение подраздела</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.section.subupdate') }}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id" value="{{ $section->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $section->title }}" placeholder="Заголовок поста">
                    </div>

                    @if ($section->icon)
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset('storage/'.$section->icon) }}" alt="icon" width="50" height="50">
                            </div>
                        </div>
                    @endif
                    

                    <div class="form-group">
                        <label for="exampleInputFile">Иконка (Формат: png)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input type="file" name="image">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Раздел</label>
                                <select class="form-control menu" name="menu">
                                    <option value="0">Выберите раздел</option>
                                    @if ($menu)
                                        @foreach ($menu as $m)
                                            <option value="{{$m->id}}" {{ $m->id == $section->parent_id ? 'selected' : ''}}>{{ $m->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
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