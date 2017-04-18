@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Forum de discussion</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio explicabo quo ut voluptatum. Aspernatur aut commodi ea eligendi exercitationem harum hic incidunt laboriosam mollitia natus quidem, quos repudiandae similique voluptate.</p>
                <table class="table table-hover">
                    <thead>

                    </thead>
                    <tbody>
                    @foreach($channels as $channel)
                        <tr class="clickable-row" data-href='{!! action('Pages\ForumsController@channel', $channel->slug) !!}'>
                            <td><i class="glyphicon glyphicon-asterisk" style="color: {!! $channel->color !!}"></i></td>
                            <td>{!! $channel->title !!}</td>
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