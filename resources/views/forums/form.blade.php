<hr>
{!! Form::model($thread,['files' => 'true', 'url' => action('Pages\ForumsController@'.$action, ['channel' => $thread]), 'method' => $action == "store_thread" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label>Titre du sujet *</label>
                    {!! Form::text('title', null,['class' => 'form-control input-lg'])  !!}
                    @if ($errors->has('title'))
                        <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group{{ $errors->has('channel') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label>Forum</label>
                    {!! Form::select('channel', $channels, $channel->id,['class' => 'form-control input-lg'])  !!}
                    @if ($errors->has('channel'))
                        <span class="help-block"><strong>{{ $errors->first('channel') }}</strong></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! Form::textarea('content', $thread->content, ['id' => 'mdeditor']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($action == 'store_thread')
                {!! Form::submit('Créer le sujet', ['class' => 'btn btn-success']) !!}
            @else
                {!! Form::submit('Editer le sujet', ['class' => 'btn btn-success']) !!}
            @endif
        </div>
    </div>
{!! Form::close() !!}