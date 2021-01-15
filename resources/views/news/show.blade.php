@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <div class="card-img"><img width="300" height="200" src="{{asset('public/storage/news/'.$item->image)}}"
                                               alt=""></div>
                    <div class="card-title" style="font-weight: bold;">{{ $item->title }}</div>
                    <div class="card-text">
                        {{ $item->full_text }} <br>
                        Views: {{ $item->views }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection