@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('roles.form', ['action' => 'store'])
                </div>
            </div>
        </div>
@endsection


