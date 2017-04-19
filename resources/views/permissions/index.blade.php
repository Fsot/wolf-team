@extends('layouts.admin')


@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Listes des permissions</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\PermissionsController@create') !!}" class="btn btn-info btn-sm">Ajouter une permission</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>id</td>
                            <td>Nom du role</td>
                            <td>Nom du role visible</td>
                            <td>Description</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{!! $permission->id !!}</td>
                                <td>{!! $permission->name !!}</td>
                                <td>{!! $permission->display_name !!}</td>
                                <td>{!! $permission->description !!}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        {!! Form::open(['url' => action('Administration\PermissionsController@destroy'), 'method' => 'delete']) !!}
                                        {!! Form::hidden('id', $permission->id) !!}
                                        {!! Form::submit('Supprimer', ['class' => 'btn btn-xs btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
