@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Liste des utilisateurs</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tous mes utilisateurs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

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
                                    @role('sup_admin')
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
    </div>


@endsection
