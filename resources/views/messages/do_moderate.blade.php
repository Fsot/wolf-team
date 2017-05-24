@extends('layouts.admin')


@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>
                Moderer un message
            </h3>
        </div>

        <div class="title_right">
            <div class="pull-right">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Message de <strong>{!! $msg->user->name !!}</strong>, posté {!! $msg->created_at !!}</h4>
                </div>
                <div class="x_content">
                    {!! Form::model($msg, ['url' => action('Administration\MessagesController@store_moderate', $msg), 'method' => 'put']) !!}
                        <div class="form-group">
                            <label>Le message de l'utilisateur</label>
                            {!! Form::textarea('content', $msg->text, ['id' => 'mdeditor']) !!}
                        </div>
                        <div class="form-group">
                            <label>Pourquoi avoir modérer ?</label>
                            {!! Form::textarea('doModerate', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Moderer', ['class' => 'btn btn-lg btn-warning']) !!}
                        <a href="{!! action('Administration\MessagesController@do_nothing', $msg) !!}" class="btn btn-lg btn-success">Ne rien faire</a>
                        <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-lg btn-default pull-right">Retour</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection