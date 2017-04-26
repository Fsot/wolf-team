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
                <div class="x_content">
                    <h4>Message de <strong>{!! $msg->user->name !!}</strong>, posté {!! $msg->created_at !!}</h4>
                    {!! Form::model($msg, ['url' => action('Administration\MessagesController@store_moderate', $msg), 'method' => 'put']) !!}
                        {!! Form::textarea('content', $msg->text, ['id' => 'mdeditor']) !!}
                        {!! Form::submit('Moderer', ['class' => 'btn btn-lg btn-warning']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection