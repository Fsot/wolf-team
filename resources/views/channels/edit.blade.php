@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="page-title">
            <div class="title_left">
                <h3>Editer un forum</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        @include('channels.form', ['action' => 'update'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





