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
                <h2>Listes des roles - <a href="{!! action('Administration\RolesController@create') !!}" class="btn btn-info btn-sm">Ajouter un role</a></h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>id</td>
                        <td>Nom du role</td>
                        <td>Nom du role visible</td>
                        <td>Description</td>
                        <td>Nombres d'utilisateurs</td>
                        <td>Permissions</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{!! $role->id !!}</td>
                                <td>{!! $role->name !!}</td>
                                <td>{!! $role->display_name !!}</td>
                                <td>{!! $role->description !!}</td>
                                <td></td>
                                <td><a href="{!! action('Administration\RolesController@edit_permission', $role->id) !!}" class="btn btn-xs btn-primary">Editer les permissions</a></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="...">
                                        {!! Form::open(['url' => action('Administration\RolesController@destroy'), 'method' => 'delete']) !!}
                                            {!! Form::hidden('id', $role->id) !!}
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