@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>{!! $thread->title !!}</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\ChannelsController@channel', $thread->channel_id) !!}" class="btn btn-default btn-sm">Retour</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-1 text-center">
            <img src="{!! $thread->messages->where('id', $thread->answer_id)->first()->user->profil->avatar($thread->messages->where('id', $thread->answer_id)->first()->user->name) !!}" alt="">
            <p>{!! $thread->messages->where('id', $thread->answer_id)->first()->user->name !!}</p>
        </div>
        <div class="col-md-11">
            <div class="x_panel">
                <div class="x_title">
                    {!! $thread->messages->where('id', $thread->answer_id)->first()->created_at !!}
                </div>
                <div class="x_content">
                    {!! $thread->messages->where('id', $thread->answer_id)->first()->text !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <h4><strong>{!! $thread->messages->whereNotIn('id',$thread->answer_id)->count() !!} réponses</strong></h4>
            <hr>
        </div>
    </div>
    @foreach($thread->messages->whereNotIn('id',$thread->answer_id) as $answer)
        <div class="row">
            <div class="col-md-1 text-center">
                <img src="{!! $answer->user->profil->avatar($answer->user->name) !!}" alt="" class="img-circle">
                <p>{!! $answer->user->name !!}</p>
            </div>
            <div class="col-md-11">
                <div class="x_panel">
                    <div class="x_title">
                        {!! $answer->created_at !!}
                    </div>
                    <div class="x_content">
                        {!! $answer->text !!}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection