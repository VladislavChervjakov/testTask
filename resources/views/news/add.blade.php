@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\News $item */  @endphp
    <form method="post" enctype="multipart/form-data"  action="{{ route('news.store')  }}">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title"></div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#maindata" class="nav-link active" role="tab">Main data</a>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="maindata" role="tabpanel">
                                            <div class="form-group">
                                                <label for="title">Title: </label>
                                                <input name="title" value=""
                                                       id="title"
                                                       minlength="3"
                                                       required
                                                       type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image: </label>
                                                <input id="image" type="file" name="file">
                                            </div>
                                            <div class="form-group">
                                                <label for="short_text">Short Text:</label><br>
                                                <textarea name="short_text"
                                                          id="short_text"
                                                          minlength="10"
                                                          required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="full_text">Full Text:</label><br>
                                                <textarea name="full_text"
                                                          cols="40"
                                                          rows="5"
                                                          id="full_text"
                                                          minlength="10"
                                                          required></textarea>
                                            </div>
                                            <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="published">Published:</label>
                                                        <input name="published" id="published" type="checkbox">
                                                    </div>
                                                <button type="submit" class="my-3 btn btn-primary">Create</button>
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
    </form>
@endsection