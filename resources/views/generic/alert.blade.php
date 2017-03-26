
    @if(session('success'))

        <div class="container">
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        </div>

    @endif


    @if(session('error'))

        <div class="container">
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        </div>

    @endif