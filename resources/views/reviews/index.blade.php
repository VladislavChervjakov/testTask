@extends('layouts.app')
@section('content')

    <div class="container">
        <a class="my-3 btn btn-success" href="{{ route('reviews.create') }}">Create review </a>
        <div class="row justify-content-around">
            @foreach($reviews as $review)
                <div class="col-md-12">
                    <div class="card text-center mb-3 py-3">
                        <div class="card-title" style="font-weight: bold;">{{ $review->title }}</div>
                        <div class="card-text">
                            Review
                            <div>Author: {{ $review->name }}</div>
                            <div>Email: {{ $review->email }}</div>
                            <span class="text">{{ $review->text }} </span> <br>
                            Created at: {{ $review->created_at }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if($reviews->total() > $reviews->count())
            <br>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection