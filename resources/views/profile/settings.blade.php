@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Settings page') }}</div>

                <div class="card-body">
                    {{dd(auth()->user()->name)}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
