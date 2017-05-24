@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Créetr un nouveau sujet sur la chaîne : {!! $channel->title !!}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <div class="btn-group" role="btn-group">
                    <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-default">Retour</a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    @include('threads.form', ['action' => 'store'])
                </div>
            </div>
        </div>
    </div>
@endsection