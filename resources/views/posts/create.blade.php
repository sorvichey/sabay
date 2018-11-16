@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9 col-sm-9">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Post&nbsp;&nbsp;
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
                    <form 
                    	action="{{url('/admin/post/save')}}" 
                    	class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"
                    >
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label for="titile">Title  <span class="text-danger">*</span></label>
                                <input type="text" required autofoucus name="title" id="title" class="form-control" placeholder="Enter title here">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <label for="titile">Short Description  <span class="text-danger">*</span></label>
                                <textarea name="short_description" id="" rows="3" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12">
                                <textarea name="description" id="description" rows="6" class="form-control ckeditor" style="width:100%;">
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
                       <option value="{{$c->id}}">{{$c->name}}</option>
                       @endforeach
                   </select>
               </div>
                  
           </div>
            <div class="card">
                <div class="card-header">
                    Featured Image <span class="text-danger">( 750 x 500 )</span>
                </div>
                <div class="card-block">
                    <div style="margin-bottom: 3px;">
                        <input type="file" name="feature_image" id="feature_image" accept="image/*" class="form-control" onchange="loadFile(event)">
                    </div>
                    <div>
                        <img src="{{asset('front/img/default.svg')}}" id="img" width="100%" alt="">
                    </div>
                </div>
                <div class="card-block">
                    <button class="btn btn-primary" type="submit">Publish</button>
                    <button class="btn btn-danger" type="reset">Cancel</button>
                </div>
            </div>
            </form>
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
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});                  
</script> 

@endsection