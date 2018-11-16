@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Video&nbsp;&nbsp;
                    <a href="{{url('/admin/video')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif
                    <form 
                        action="{{url('/admin/video/update')}}" 
                        class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$video->id}}">
                        <div class="form-group row">
                            <label for="title" class="control-label col-lg-2 col-sm-2">Title <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="title" name="title" id="title" required value="{{$video->title}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="short_description" class="control-label col-lg-2 col-sm-2">Short Description <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <textarea name="short_description" id="short_description" class="form-control"  rows="3">{{$video->short_description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-2 col-sm-2">URL <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" required class="form-control" value="{{$video->url}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="control-label col-lg-2 col-sm-2">Poster Image <span class="text-danger">(750x500)</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="image" id="image" accept="image/*" onchange="loadFile(event)">
                                <img src="{{asset('uploads/videos/'.$video->poster_image)}}" id="img" width="120" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                             <div class="row">
                            <div class="col-lg-8 col-sm-8">
                                <textarea name="description" id="description" rows="6" class="form-control ckeditor" style="width:100%;"> {{$video->description}}
                                </textarea>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save Change</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
.cke_contents {
  max-height: 800px;
  height: 800px !important;
}</style>
@endsection
@section('js')
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
<script src="{{asset('js/ckeditor2/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});                  
</script> 
@endsection