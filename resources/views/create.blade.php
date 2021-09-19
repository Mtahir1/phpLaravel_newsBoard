@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
        @if(session('statusSuccess'))
            <h6 class="alert alert-success">{{ session('statusSuccess')}}</h6>
            <a href="{{ url('news') }}" class="btn btn-danger float-end"> Back to News Portal </a>
        @else
            @if(session('statusFailHead'))
                <h6 class="alert alert-danger">{{ session('statusFailHead')}}</h6>
            @endif
            @if(session('statusFailBody'))
                <h6 class="alert alert-danger">{{ session('statusFailBody')}}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                <h4> Add News with Image 
                    <a href="{{ url('news') }}" class="btn btn-danger float-end"> Back to News Portal </a>
                </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('create-news') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Headline (characters Limit: min 10, max 50)</label>
                            <input type="text" name="newsHead" id="form1" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description of News (characters Limit: min 10, max 100)</label>
                            <input type="text" name="newsBody" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Attach Image</label>
                            <input type="file" name="newsImage" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary"> Save News</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
  </div>
</div>

@endsection