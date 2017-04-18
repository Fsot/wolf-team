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
                <h2>{!!  $channel->title !!} <a href="{!! action('Administration\ChannelsController@create') !!}" class="btn btn-info">Retour</a></h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td></td>
                        <td>Nom du sujet</td>
                        <td class="text-center">Messages</td>
                        <td>Dernier message</td>
                        <td style="width: 135px">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($threads as $thread)
                        <tr>
                            <td>{!! $thread->id !!}</td>
                            <td><a href="{!! action('Administration\ThreadsController@thread', $thread) !!}">{!! $thread->title !!}</a></td>
                            <td class="text-center">{!! $thread->messages->whereNotIn('id', $thread->answer_id)->count() !!}</td>
                            <td>
                                @if($thread->messages->last()->id != $thread->answer_id)
                                    De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                    De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                    <i><small>{!! $thread->messages->last()->created_at !!}</small></i>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{!! action('Administration\ThreadsController@thread', $thread) !!}" class="btn btn-xs btn-info">Editer</a>
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