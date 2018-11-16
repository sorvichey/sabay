@extends('layouts.app')
@section('content')
<form 
    action="{{url('/admin/post/update')}}" 
    class="form-horizontal" 
    method="post"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-9 col-sm-9">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Post&nbsp;&nbsp;
                    <a href="{{url('/admin/post')}}" class="btn btn-link btn-sm">Back To List</a>
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
                        {{csrf_field()}}
                        <input type="hidden" id="id" name="id" value="{{$post->id}}">
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label for="titile">Title  <span class="text-danger">*</span></label>
                                <input type="text" required  name="title" id="title" class="form-control" value="{{$post->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label for="titile">Short Description  <span class="text-danger">*</span></label>
                                <textarea name="short_description" id="" rows="3" class="form-control" required>{{$post->short_description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <textarea name="description" id="description" rows="6" class="form-control ckeditor">{{$post->description}}
                                </textarea>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        Category
                    </div>
                    <div class="card-block">
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $c)
                            <option value="{{$c->id}}"​ {{$c->id==$post->category_id?'selected':''}}>{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                <div class="card">
                        <div class="card-header">
                            Feature Image <span class="text-danger">(750 x 500)</span>
                        </div>
                        <div class="card-block">
                            <div style="margin-bottom: 3px;">
                                <input type="file" name="feature_image" id="feature_image" accept="image/*" class="form-control" onchange="loadFile(event)">
                            </div>
                            @if($post->featured_image != null) 
                            <img src="{{asset('uploads/posts/small/'.$post->featured_image)}}" width="100%" id="img">
                            @else 
                            <img src="{{asset('front/img/default.svg')}}" width="100%" id="img">
                            @endif
                        </div>
          
              
                <div class="card-block">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                </div>
            </div>
            
        </div>
    </div>
    </form>
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
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

</script> 
@endsection