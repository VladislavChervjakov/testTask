@extends('layouts.app')
@section('content')
    @if($errors->any())
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ $errors->first()  }}
                </div>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">x</span>
                    </button>
                    {{ session()->get('success')  }}
                </div>
            </div>
        </div>
    @endif
    <div class="col-md-12 justify-content-center">
        <form method="post" enctype="multipart/form-data"  action="{{ route('reviews.update', $item->id)  }}">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Name: </label>
                <input name="name" value="{{ $item->name }}"
                       id="name"
                       minlength="3"
                       required
                       type="text">
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input name="email" value="{{ $item->email }}"
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
                              required>{{ $item->text }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="published">Published:</label>
                <input name="published"
                       @if($item->is_published) checked @endif id="published" type="checkbox">
            </div>
            <div class="form-group">
                <button type="submit" class="my-3 btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
