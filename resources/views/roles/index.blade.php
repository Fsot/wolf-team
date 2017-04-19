@extends('layouts.admin')


@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Liste des roles</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\RolesController@create') !!}" class="btn btn-info btn-sm">Ajouter un role</a>
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
    </div>
@endsection