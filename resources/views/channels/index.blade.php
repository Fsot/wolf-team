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
                <h2>Liste des forums <a href="{!! action('Administration\ChannelsController@create') !!}" class="btn btn-info">Ajouter un forum</a>
                    @if($settings->where('name','forum_on')->first()->value == 0)
                        <a href="{!! action('Administration\ChannelsController@activate_forum') !!}" class="btn btn-success"><i class="glyphicon glyphicon-off"></i></a></h2>
                    @else
                        <a href="{!! action('Administration\ChannelsController@desactivate_forum') !!}" class="btn btn-danger"><i class="glyphicon glyphicon-off"></i></a></h2>
                    @endif
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td></td>
                        <td>Nom du forum</td>
                        <td>Icone</td>
                        <td>Couleur</td>
                        <td>Sujets</td>
                        <td style="width: 135px">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{!! $channel->id !!}</td>
                            <td><a href="{{ action('Administration\ChannelsController@channel', $channel) }}">{!! $channel->title !!} </a></td>
                            <td>{!! $channel->icon !!} </td>
                            <td>{!! $channel->color !!} </td>
                            <td style="text-align: center">{!! $channel->threads->count() !!} </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ action('Administration\ChannelsController@edit', $channel->id) }}" class="btn btn-xs btn-info">Editer</a>
                                    <a href="" class="btn btn-xs btn-danger">Supprimer</a>
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
