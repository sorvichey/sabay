@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Detail Post&nbsp;&nbsp;
                    <a href="{{url('/admin/post')}}" class="btn btn-link btn-sm">Back To List</a> | 
                    <a href="{{url('/admin/post/edit/'.$post->id)}}" class="btn btn-link text-danger btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="success"><small class="text-danger">Create Date: {{$post->create_at}}</small> </aside>
                        </label>  
                    </div> 
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Title</aside>
                            <aside>{{$post->title}}</aside>
                        </label>
                       
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-6">
                            <aside class="text-primary">Feature Image</aside>
                            @if($post->featured_image != null) 
                            <img src="{{asset('uploads/posts/'.$post->featured_image)}}" width="150">
                            @else 
                            <img src="{{asset('front/img/default.svg')}}" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Short Descritpion</aside>
                            <aside>{{$post->short_description}}</aside>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Description</p>
                            <p>{!!$post->description!!}</p>
                        </label>
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection