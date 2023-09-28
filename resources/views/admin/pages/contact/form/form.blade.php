@extends('admin.layouts.app')

@section('page_title') Все заявки @endsection

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
                <h3 class="card-title">Все заявки</h3>
            </div>
            
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_desc" tabindex="0" aria-controls="example2" rowspan="1" colspan="6" width="95%" aria-sort="descending">Тема</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" >Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($questions)
                                        @foreach ($questions as $question)
                                            <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                                <td class="dtr-control sorting_1" tabindex="0" colspan="6">
                                                    <a href="{{ route('admin.contact.mail', ['id' => $question->id]) }}">{{ $question->topic }}</a>
                                                </td>
                                                
                                                <td>
                                                    <div class="table-action">
                                                        {{-- <a href="{{ route('admin.contact.mail', ['id' => $question->id]) }}"  class="btn btn-block btn-outline-primary table-action__btn-edit"><i class="nav-icon fas fa-edit"></i></a> --}}
                                                        <form action="{{ route('admin.contact.delete') }}" class="delete-route" method="POST">
                                                            @CSRF
                                                            <input type="hidden" name="id" value="{{ $question->id }}">
                                                            <button style="margin-left: 0;" type="submit" class="delete-btn btn btn-block btn-outline-danger table-action__btn-delete"><i class="nav-icon far fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            {{ $questions->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
            

@endsection


@section('custom_script')
    <script src="{{ asset("assets/js/admin.js") }}"></script>
@endsection