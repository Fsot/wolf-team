@extends('layouts.admin')

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Ajouter une permission</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{!! action('Administration\PermissionsController@index') !!}" class="btn btn-default btn-sm">Retour</a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    @include('permissions.form', ['action' => 'store'])
                </div>
            </div>
        </div>
    </div>
@endsection