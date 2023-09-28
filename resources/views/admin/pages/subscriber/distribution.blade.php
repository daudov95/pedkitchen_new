@extends('admin.layouts.app')

@section('page_title') Все рассылки @endsection

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
                <h3 class="card-title">Все рассылки</h3>
            </div>
            
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                <thead>
                                    <tr>
                                        <th class="sorting sorting_desc" tabindex="0" aria-controls="example2" width="80%" aria-sort="descending">Категория</th>
                                        <th class="sorting" tabindex="0" aria-controls="example2"  >Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($distributions)
                                        @foreach ($distributions as $distribution)
                                            <tr class="{{ $loop->odd ? 'odd' : 'even' }}">
                                                <td class="dtr-control sorting_1" tabindex="0">
                                                    {{ $distribution->section->title }}
                                                </td>

                                                <td class="dtr-control sorting_1" tabindex="0" with="30%">
                                                    {{ $distribution->created_at }}
                                                </td>
                                            </tr>
                                            @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th  width="80%" >Категория</th>
                                    <th >Дата</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            {{ $distributions->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
            
        

@endsection