@extends('layouts.app')

@section('content')
    <div class="container">
        @include('profils.header')
        @include('profils.form', ['action' => 'update'])
    </div>
@endsection


@section('js')
    <script>
        $('.input-group.date').datepicker({
            format: "dd/mm/yyyy",
            clearBtn: true,
            language: "fr",
        });
    </script>
@endsection