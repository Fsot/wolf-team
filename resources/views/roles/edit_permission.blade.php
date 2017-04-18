@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Permission du rôle</h2>
                <ul class="list-unstyled">
                    @foreach($role->perms as $perm)
                        <li>
                            {!! $perm->display_name !!}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Liste des permissions disponible</h2>
                {!! Form::open(['url' => action('Administration\RolesController@update_permission', $role), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}

                @foreach($permissions as $permission)
                    <div class="checkbox">
                        <label>
                            {!! Form::checkbox($permission->display_name,$permission->name, $role->perms->contains('name', $permission->name) ? true : false) !!}
                            <span>{!! $permission->display_name !!}</span>
                        </label>
                    </div>
                @endforeach

                <div class="form-group">
                    <div class="btn-group pull-right"  role="group">
                        {!! Form::submit('Sauvegarder les permissions', ['class' => 'btn btn-success']) !!}
                        <a href="{{ action('Administration\RolesController@index') }}" class="btn btn-default">Retour</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection