@extends('admin.layouts.app')

@section('page_title') Все пособии @endsection

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
            <div class="card-header" style="display: flex">
                <h3 class="card-title">Все пособии</h3>
                <a href="{{ route('admin.cookbook.benefits.create') }}" style="margin-left: auto">Создать новый</a>
            </div>
            
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_desc" tabindex="0" width="95%">Пособия</th>
                                        <th class="sorting" tabindex="0" >Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($posts)
                                        @foreach ($posts as $post)
                                            <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                                <td class="dtr-control sorting_1" tabindex="0">
                                                    <a href="{{ route('cookbook.benefits.show', ['post' => $post->id]) }}" target="__blank">{{ $post->title }}</a>
                                                </td>

                                                <td>
                                                    <div class="table-action">
                                                        <a href="{{ route('admin.cookbook.benefits.edit', ['id' => $post->id]) }}"  class="btn btn-block btn-outline-primary table-action__btn-edit"><i class="nav-icon fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.cookbook.benefits.delete') }}" class="delete-route" method="POST">
                                                            @CSRF
                                                            <input type="hidden" name="id" value="{{ $post->id }}">
                                                            <button type="submit" class="delete-btn btn btn-block btn-outline-danger table-action__btn-delete"><i class="nav-icon far fa-trash-alt"></i></button>
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
                            {{ $posts->links() }}
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