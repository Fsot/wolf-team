@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Editer les permissions du role : <strong>{!! $role->display_name !!}</strong></h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\RolesController@index') !!}" class="btn btn-default btn-sm">Retour</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Permission du rôle</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled">
                        @foreach($role->perms as $perm)
                            <li>
                                {!! $perm->display_name !!}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste des permissions disponible</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
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
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection


