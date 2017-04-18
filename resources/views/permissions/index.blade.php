@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="btn-group-vertical" role="group" aria-label="...">
                    <a href="{!! action('Administration\UsersController@index') !!}" type="button" class="btn btn-default">Utilisateurs</a>
                    <a href="{!! action('Administration\RolesController@index') !!}" type="button" class="btn btn-default">Roles</a>
                    <a href="{!! action('Administration\PermissionsController@index') !!}" type="button" class="btn btn-default">Permissions</a>
                </div>
            </div>
            <div class="col-md-10">
                <h2>Listes des permissions - <a href="{!! action('Administration\PermissionsController@create') !!}" class="btn btn-info btn-sm">Ajouter une permission</a></h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Nom du role</td>
                        <td>Nom du role visible</td>
                        <td>Description</td>
                        <td>Nombres d'utilisateurs</td>
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
                                <td></td>
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
@endsection