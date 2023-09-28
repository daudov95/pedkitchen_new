@extends('admin.layouts.app')


@section('page_title') Изменение баннера @endsection


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
            <h3 class="card-title">Изменение баннера</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.banner.update') }}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" value="{{ $banner->id }}" name="banner_id">

                <div class="card-body">

                    @if (isset($banner->image))
                        <img src="{{ asset('storage/'. $banner->image) }}" alt="banner" style="max-width: 100%; margin-bottom: 20px;">
                    @endif

                    <div class="form-group">
                        <label for="exampleInputFile">Картинка (Формат: jpg, png)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input type="file" name="image">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="link">Ссылка (если переход не нужен, оставить пустым)</label>
                        <input type="text" class="form-control" id="link" name="link" value="{{ $banner->link }}" placeholder="Введите ссылку">
                    </div>

                    <div class="form-group">
                        <label for="banner_order">Очередность баннера (цифры)</label>
                        <input type="text" class="form-control" id="banner_order" name="banner_order" value="{{ $banner->banner_order }}" placeholder="Введите очередность">
                    </div>

                </div>
                

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div>
            </form>
        </div>

    </div>
</div>
            

@endsection