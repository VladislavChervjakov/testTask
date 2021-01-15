@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Hi '.\Illuminate\Support\Facades\Auth::user()->name).'!' }}

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#news" data-toggle="tab" class="nav-link active" role="tab">News</a>
                            </li>
                            <li class="nav-item">
                                <a href="#reviews"
                                   data-toggle="tab" role="tab" class="nav-link">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="news" role="tabpanel">
                                <div class="my-3 row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <div class="py-12">
                                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                        <div class="p-6 bg-white border-b border-gray-200">
                                                            <p><a class="btn btn-success"
                                                                  href="{{ route('news.create') }}">Add news +</a></p>
                                                            <table class="table">
                                                                <tr class="text-center">
                                                                    <th>Preview</th>
                                                                    <th>Name</th>
                                                                    <th>Short Text</th>
                                                                    <th>Published</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                @foreach($news as $item)
                                                                    <tr class="text-center">
                                                                        <td>
                                                                            <img width="100" height="100"
                                                                                 src="{{asset('public/storage/news/'.$item->image)}}"
                                                                                 alt="">
                                                                        </td>
                                                                        <td> {{ $item->title }} </td>
                                                                        <td style="max-width: 100px"> {{ $item->short_text  }} </td>
                                                                        <td> @if($item->is_published === 1)
                                                                                Yes
                                                                            @else No
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('news.edit', $item->id) }}"
                                                                               class="btn btn-primary mb-2">Edit</a>
                                                                            <a href="{{ route('news.show', $item->id) }}"
                                                                               class="btn btn-info mb-2">View</a>
                                                                            <form id="delete-form" method="POST"
                                                                                  style="display: inline-block;"
                                                                                  action="{{ route('news.destroy', $item->id)  }}">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                                <div class="form-group">
                                                                                    <input onclick="return confirm('Are you sure?')"
                                                                                           type="submit"
                                                                                           class="mb-2 btn btn-danger"
                                                                                           value="Delete">
                                                                                </div>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="reviews" role="tabpanel">
                                <div class="my-3 row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                            <div class="py-12">
                                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                        <div class="p-6 bg-white border-b border-gray-200">
                                                            <table class="table">
                                                                <tr class="text-center">
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Text</th>
                                                                    <th>Published</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                                @foreach($reviews as $item)
                                                                    <tr class="text-center">
                                                                        <td> {{ $item->name }} </td>
                                                                        <td> {{ $item->email }} </td>
                                                                        <td style="max-width: 100px"> {{ $item->text  }} </td>
                                                                        <td>
                                                                            @if($item->is_published === 1)
                                                                                Yes
                                                                                @else No
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('reviews.edit', $item->id) }}"
                                                                               class="btn btn-primary mb-2">Edit</a>
                                                                            <form id="delete-form" method="POST"
                                                                                  style="display: inline-block;"
                                                                                  action="{{ route('reviews.destroy', $item->id)  }}">
                                                                                {{ csrf_field() }}
                                                                                {{ method_field('DELETE') }}
                                                                                <div class="form-group">
                                                                                    <input onclick="return confirm('Are you sure?')"
                                                                                           type="submit"
                                                                                           class="mb-2 btn btn-danger"
                                                                                           value="Delete">
                                                                                </div>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
