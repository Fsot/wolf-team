@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Forum de discussion</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio explicabo quo ut voluptatum. Aspernatur aut commodi ea eligendi exercitationem harum hic incidunt laboriosam mollitia natus quidem, quos repudiandae similique voluptate.</p>
                @foreach($channels as $k => $c)
                    <h3>{!! $k !!}</h3>
                    <table class="table table-hover">
                        <thead>

                        </thead>
                        <tbody>
                        @foreach($c as $channel)
                            <tr class="clickable-row" data-href='{!! action('Pages\ForumsController@channel', $channel->slug) !!}'>
                                <td style="width:20px;"><span class="glyphicon glyphicon-stop @if($channel->new_msg == true) text-success @endif"></span></td>
                                <td>{!! $channel->title !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
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