@extends('admin.layouts.app')

@section('page_title') 
    @if (!$question->status) 
        Открытая заявка
    @else 
        Закрытая заявка
    @endif 
@endsection

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

        @include('admin.parts.errors')

        <div class="card">
            <div class="card-header">
                <h1 class="card-title"><span style="font-weight: bold;">[{{ $question->name }}]:</span> {{ $question->topic }}</h1>
            </div>
            
            <form method="POST" action="{{ route('admin.contact.store') }}" enctype="multipart/form-data">
                @CSRF
                <input type="hidden" name="id" value="{{ $question->id }}">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">


                            <div class="col-12">
                                <div class="form-group">
                                    <label>Вопрос:</label>
                                    <p>{{ $question->message }}</p>
                                </div>
                            </div>

                            @if (count($question->replies))
                                @foreach ($question->replies as $reply)
                                    <div class="col-12">
                                        <div class="card-body">
                                            <div class="callout callout-success">
                                                <h5>{{ $reply->message }}</h5>
                                                <p>Ответили {{ $reply->created_time }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                            
                        
                            @if (!$question->status)
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Сообщение</label>
                                        <textarea name="message" class="form-control" rows="3" placeholder="Пишите...">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            @endif


                        </div>


                    </div>
                </div>
                @if (!$question->status)
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ответить</button>
                        <a href="{{ route('admin.contact.close', ['id' => $question->id]) }}" class="btn btn-danger">Закрыть заявку</a>
                    </div>
                @endif
                
            </form>

        </div>
    </div>
</div>
            
        

@endsection