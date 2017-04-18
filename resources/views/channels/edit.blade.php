@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('channels.form', ['action' => 'update'])
                </div>
            </div>
        </div>
@endsection


