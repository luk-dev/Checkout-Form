<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('welcome.headTitle')</title>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>@lang('welcome.titleH1')</h1>

                @if ($errors->count())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                    @endforeach
                </div>
                @endif
              
                @if(!empty(Session::get('data'))) 
                    <div class="alert alert-success" role="alert">
                        <h3>@lang('welcome.responseTitle')</h3>
                        <h4>@lang('welcome.responseSubTitle')</h4>
                        <p>@lang('welcome.responseName') <strong>{!! Session::get('data')->name !!}</strong></p>
                        <p>@lang('welcome.responseEmail') <strong>{!! Session::get('data')->email !!}</strong></p>
                        <p>@lang('welcome.responseContent') <strong>{!! Session::get('data')->content !!}</strong></p>
                    </div>
                @endif
     
                <form method="POST" action="{{ url('create') }}">
                    {!! csrf_field() !!}

                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        <label for="name">@lang('welcome.formName')</label>
                        <input type="text" required id="name" class="form-control" name="name" placeholder="@lang('welcome.formPlaceholderName')" value="{{ Input::old('name') }}">
                    </div>

                    <div class="form-group @if ($errors->has('email')) has-error @endif">
                        <label for="email">@lang('welcome.formEmail')</label>
                        <input type="email" required id="email" class="form-control" name="email" placeholder="@lang('welcome.formPlaceholderEmail')" value="{{ Input::old('email') }}">
                    </div>

                    <div class="form-group @if ($errors->has('content')) has-error @endif">
                        <label for="content">@lang('welcome.formText')</label>
                        <textarea rows="4" cols="50" type="text" required id="content" class="form-control" name="content" placeholder="@lang('welcome.formPlaceholderText')">{{ Input::old('content') }}</textarea>
                        </p>
                    </div>

                    <button type="submit" class="btn btn-success">@lang('welcome.formSubmit')</button>

                </form>
            </div>
        </div>
    </div>

    <script url="{{ url('js/app.js') }}"></script>
</body>
</html>