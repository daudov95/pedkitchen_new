@extends('admin.layouts.app')


@section('page_title') Создание пользователя @endsection


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
            <h3 class="card-title">Создание пользователя</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.user.create') }}">
                @CSRF

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Введите ФИО">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Введите e-mail">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Введите пароль">
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