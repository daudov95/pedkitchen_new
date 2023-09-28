@extends('admin.layouts.app')


@section('page_title') Создание нового подраздела @endsection


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
        {{-- {{ print_r(explode('.', request()->route()->getName())) }} --}}

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
            <h3 class="card-title">Создание нового подраздела</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.section.subcreate') }}" enctype="multipart/form-data">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Заголовок поста">
                    </div>

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
                                            <option value="{{$m->id}}" {{ $m->id == old('menu') ? 'selected' : ''}}>{{ $m->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
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