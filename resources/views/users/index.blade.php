@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="btn-group-vertical" role="group" aria-label="...">
                    <a href="{!! action('Administration\UsersController@index') !!}" type="button" class="btn btn-default">Utilisateurs</a>
                    <a href="{!! action('Administration\RolesController@index') !!}" type="button" class="btn btn-default">Roles</a>
                    <a href="{!! action('Administration\PermissionsController@index') !!}" type="button" class="btn btn-default">Permissions</a>
                    <a href="{!! action('Administration\ChannelsController@index') !!}" type="button" class="btn btn-default">Forum</a>
                </div>
            </div>
            <div class="col-md-10">
                <h2>Liste des utilisateurs</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td></td>
                        <td>username</td>
                        <td>email</td>
                        <td>date d'inscription</td>
                        <td>Coins</td>
                        <td>Role</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="label label-info">{!! $role->display_name !!}</span>
                                @endforeach
                            </td>
                            <td>{!! $user->name !!} </td>
                            <td>{!! $user->email !!}</td>
                            <td>{!! $user->created_at !!}</td>
                            <td>{!! $user->profil->coins !!}</td>
                            <td>
                                @role('admin')
                                    {!! Form::open(['url' => action('Administration\UsersController@assign_role', $user), 'action' => 'post', 'class' => 'form-inline']) !!}
                                        {!! Form::select('role', $roles) !!}
                                        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-xs btn-success']) !!}
                                    {!! Form::close() !!}
                                @endrole
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
