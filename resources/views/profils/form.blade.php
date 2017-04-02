{!! Form::model($data['profil'],['files' => 'true', 'url' => action('Pages\ProfilsController@'.$action, ['profil' => $data['profil']]), 'method' => $action == "store" ? 'Post' : 'Put', 'class' => 'form-horizontal'])  !!}

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Informations sur vous ...
        </span>
    </h3>
    <div class="content-box-wrapper">

        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Votre prénom</label>
                {!! Form::text('firstname', null,['class' => 'form-control input-lg', 'placeholder' => 'Jon'])  !!}
                @if ($errors->has('firstname'))
                    <span class="help-block"><strong>{{ $errors->first('firstname') }}</strong></span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <label>Votre nom:</label>
                {!! Form::text('lastname', null,['class' => 'form-control input-lg', 'placeholder' => 'Doe'])  !!}
                @if ($errors->has('lastname'))
                    <span class="help-block"><strong>{{ $errors->first('lastname') }}</strong></span>
                @endif
            </div>
        </div>

    </div>
</div>

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Quand doit t'on fêter votre anniversaire ?
        </span>
    </h3>
    <div class="content-box-wrapper">
        <div class="input-group date {{ $errors->has('birthday') ? ' has-error' : '' }}">
            {!! Form::text('birthday', null,['class' => 'form-control input-lg'])  !!}
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
        @if ($errors->has('birthday'))
            <span class="help-block"><strong>{{ $errors->first('birthday') }}</strong></span>
        @endif
    </div>
</div>

<div class="content-box">
    <h3 class="content-box-header content-box-header-alt bg-default">
        <i class="glyph-icon icon-linecons-cog"></i>
        <span class="header-wrapper">
                Votre avatar
        </span>
    </h3>
    <div class="content-box-wrapper">
        {!! Form::file('avatar', null,['class' => 'form-control input-lg'])  !!}
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
                <a href="{!! action('Pages\ProfilsController@index', $data['user']->name) !!}" class="btn btn-lg btn-default btn-block">Retour au profil</a>
            </div>
        </div>
    </div>
</div>


{!! Form::close() !!}