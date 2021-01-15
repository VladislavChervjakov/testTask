@extends('layouts.app')
@section('content')
    <div class="container">
        @if($news->count() > 0)
        <a href="{{ route('news.orderByDate') }}" class="my-3 date-sort btn btn-success">Sort by date</a>
        <a href="{{ route('news.orderByViews') }}" class="my-3 views-sort btn btn-primary">Sort by views</a>
        <a href="{{ route('news.index') }}" class="btn btn-danger">Reset sortings</a>
        @endif
        <div class="item row justify-content-around">
            @foreach($news as $item)
                <div class="col-md-5">
                    <div class="card text-center mb-3 py-3">
                        <div class="card-img"><img width="300" height="200"
                                                   src="{{asset('public/storage/news/'.$item->image)}}"
                                                   alt=""></div>
                        <div class="card-title" style="font-weight: bold;">{{ $item->title }}</div>
                        <div class="card-text">
                            <span class="text">{{ $item->short_text }} </span> <br>
                            <span class="views"> Views: {{ $item->views }} </span> <br>
                            Created at: {{ $item->created_at }}
                        </div>
                        <a class="mx-2 btn btn-primary" href="{{ route('news.show', $item->id) }}">Read more...</a>
                    </div>
                </div>
            @endforeach
        </div>
        @if($news->total() > $news->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $news->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection