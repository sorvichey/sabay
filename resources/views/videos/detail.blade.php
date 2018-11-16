@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Detail Video&nbsp;&nbsp;
                    <a href="{{url('/admin/video')}}" class="btn btn-link btn-sm">Back To List</a> | 
                    <a href="{{url('/admin/video/edit/'.$video->id)}}" class="btn btn-link text-danger btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="success"><small class="text-danger">Create Date: {{$video->create_at}}</small> </aside>
                        </label>  
                    </div>
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Title</aside>
                            <aside>{{$video->title}}</aside>
                        </label>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6">
                            <aside class="text-primary">Feature Image</aside>
                            @if($video->poster_image != null) 
                            <img src="{{asset('uploads/videos/'.$video->poster_image)}}" width="150">
                            @else 
                            <img src="{{asset('fronts/img/default.jpg')}}" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Short Descritpion</aside>
                            <aside>{{$video->short_description}}</aside>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Description</p>
                            <p>{!!$video->description!!}</p>
                        </label>
                    </div>       
                </div>
            </div>
        </div>
    </div>
@endsection