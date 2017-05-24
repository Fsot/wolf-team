@extends('layouts.admin')


@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Sécurité liées aux utilisateurs</h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="x_panel">
        <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="security_tab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#journal_connexion" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Journal de connexion</a>
                    </li>
                </ul>
                <div id="security_tabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="journal_connexion" aria-labelledby="home-tab">
                        <div class="btn-group pull-right">
                            <button type="button" onclick="event.preventDefault(); if(confirm('Voulez-vous supprimer toutes les données de connexion ? ')){document.getElementById('drop_user_connexion').submit();}" class="btn btn-danger">Vider les données</button>
                            <a href="" class="btn btn-info">Exporter les données</a>
                        </div>
                        <div class="clearfix"></div>
                        <br><br>
                        {!! Form::open(['url' => action('Administration\SecuritiesController@drop_user_connexion'), 'method'=> 'delete' ,'id' => 'drop_user_connexion']) !!}
                        {!! Form::close() !!}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID de l'utilisateur</th>
                                <th>Nom de l'utilsateur</th>
                                <th>Email de l'utilisateur</th>
                                <th>IP de l'utilisateur</th>
                                <th>Date de connexion</th>
                                <th>Browser agent</th>
                                <th>Success</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($loginAttemtps as $loginAttemtp)
                                    <tr>
                                        <th scope="row">{!! $loginAttemtp->user_id !!}</th>
                                        <td>@if(isset($loginAttemtp->user['name'])){!! $loginAttemtp->user['name'] !!}@else <div class="label label-danger">Utilisateur non reconnu</div> @endif</td>
                                        <td>{!! $loginAttemtp->user['email'] !!}</td>
                                        <td>{!! $loginAttemtp->login_ip !!}</td>
                                        <td>{!! $loginAttemtp->login_time !!}</td>
                                        <td>{!! $loginAttemtp->browser_agent !!}</td>
                                        <td>@if($loginAttemtp->success == true) <span class="label label-success">Successfully</span> @else <div class="label label-danger">failed</div> @endif</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $paginate !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection