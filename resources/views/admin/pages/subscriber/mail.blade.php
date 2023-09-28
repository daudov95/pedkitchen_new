@extends('admin.layouts.app')

@section('page_title') Рассылка @endsection

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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Рассылка</h3>
            </div>
            
            <form method="POST" action="{{ route('admin.subscriber.distributionStore') }}" enctype="multipart/form-data">
                @CSRF
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
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

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Сообщение</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="Пишите...">{{ old('message') }}</textarea>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Сделать рассылку</button>
                </div>
            </form>

        </div>
    </div>
</div>
            
        

@endsection