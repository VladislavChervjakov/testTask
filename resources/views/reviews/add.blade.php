@extends('layouts.app')
@section('content')
    <div class="col-md-12 justify-content-center">
        <form method="post" enctype="multipart/form-data"  action="{{ route('reviews.store')  }}">
            @csrf
            <div class="form-group">
                <label for="name">Name: </label>
                <input name="name" value=""
                       id="name"
                       minlength="3"
                       required
                       type="text">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input name="email" value=""
                       id="title"
                       minlength="3"
                       required
                       type="email">
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="text">Text:</label><br>
                    <textarea name="text"
                              cols="40"
                              rows="5"
                              id="text"
                              minlength="10"
                              required></textarea>
                </div>
            </div>
            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                <label class="col-md-4 control-label">Captcha</label>
                <div class="col-md-6 pull-center">
                    {!! app('captcha')->display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="my-3 btn btn-primary">Create</button>
            </div>
        </form>
    </div>
    {!! NoCaptcha::renderJs() !!}
@endsection
