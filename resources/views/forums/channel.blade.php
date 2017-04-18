@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-right">
                    @if(Auth::check())
                        @if($channel->block == 1 && Auth::user()->can('add_thread_channel_block'))
                            <a href="{!! action('Pages\ForumsController@create_thread', $channel->id) !!}" class="btn btn-lg btn-success ">Nouveau sujet</a>
                        @elseif($channel->block == 0 && Auth::user()->can('add_thread'))
                            <a href="{!! action('Pages\ForumsController@create_thread', $channel->id) !!}" class="btn btn-lg btn-success ">Nouveau sujet</a>
                        @endif
                    @endif
                    <a href="{!! action('Pages\ForumsController@index') !!}" class="btn btn-lg btn-default">Retour au forum</a>
                </div>
                <h1>{!! $channel->title !!}</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio explicabo quo ut voluptatum. Aspernatur aut commodi ea eligendi exercitationem harum hic incidunt laboriosam mollitia natus quidem, quos repudiandae similique voluptate.</p>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td></td>
                            <td>Sujet</td>
                            <td class="text-center" style="width: 150px;">Réponses</td>
                            <td style="width: 250px;">Dernier message</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($threads as $thread)
                            <tr class="clickable-row" data-href='{!! action('Pages\ForumsController@thread', $thread->slug) !!}'>
                                <td></td>
                                <td>{!! $thread->title !!}</td>
                                <td class="text-center">{!! $thread->messages->whereNotIn('id', $thread->answer_id)->count() !!}</td>
                                <td>
                                    @if($thread->messages->last()->id != $thread->answer_id)
                                        De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                        De <strong>{!! $thread->messages->last()->user->name !!}</strong>,
                                    <i><small>{!! $thread->messages->last()->created_at !!}</small></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection