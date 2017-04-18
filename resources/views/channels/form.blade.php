{!! Form::model($channel,['files' => 'true', 'url' => action('Administration\ChannelsController@'.$action, ['channel' => $channel]), 'method' => $action == "store" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Ajouter un sujet
        </span>
    </h3>
    <div class="content-box-wrapper">

        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Titre du sujet</label>
                {!! Form::text('title', null,['class' => 'form-control input-lg', 'placeholder' => 'Règles de bonne conduite'])  !!}
                @if ($errors->has('title'))
                    <span class="help-block"><strong>{{ $errors->first('title') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Couleur</label>
                {!! Form::select('color', $color, null, ['class' => 'form-control'])  !!}
                @if ($errors->has('color'))
                    <span class="help-block"><strong>{{ $errors->first('color') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Icon</label>
                {!! Form::select('icon', $icon, null, ['class' => 'form-control'])  !!}
                @if ($errors->has('icon'))
                    <span class="help-block"><strong>{{ $errors->first('icon') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('block') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>{!! Form::checkbox('block', null, $channel->block)  !!} Bloquer le forum</label>
                @if ($errors->has('block'))
                    <span class="help-block"><strong>{{ $errors->first('block') }}</strong></span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="content-box">
    <hr>
    <div class="content-box-wrapper">
        <div class="form-group">
            <div class="col-md-12">
                {!! Form::submit('Sauvegarder', ['class' => 'btn btn-lg btn-primary btn-block'])  !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <a href="{!! action('Administration\ChannelsController@index') !!}" class="btn btn-lg btn-default btn-block">Retour à la liste des sujets</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}