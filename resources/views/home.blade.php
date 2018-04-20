@extends('layouts.app')

<style>
    .title {
        font-size: 84px;
    }
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Silahkan Pilih Menu</div>

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif 
                    Daftar menu 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection