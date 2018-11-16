@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Advertisement&nbsp;&nbsp;
                    <a href="{{url('/admin/advertisement')}}" class="btn btn-link btn-sm">Back To List</a>
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
                        action="{{url('/admin/advertisement/update')}}" 
                        class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <input type="hidden" name="id" id="id" value="{{$advertisement->id}}">
                        <div class="form-group row">
                            <label for="url" class="control-label col-lg-1 col-sm-2">URL</label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" name="url" id="url" class="form-control" value="{{$advertisement->url}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="position" class="control-label col-lg-1 col-sm-2">Position<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <select class="form-control" required name="position" id="position"  id="exampleSelect1">
                                    <option value="Bottom"  {{$advertisement->position=='Button'?'selected':''}}>Bottom</option> 
                                    <option value="Right"  {{$advertisement->position=='Right'?'selected':''}}>Right</option>  
                                    <option value="Top"  {{$advertisement->position=='Top'?'selected':''}}>Top</option>               
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="order_number" class="control-label col-sm-2 col-lg-1">Order</label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" class="form-control" id="order_number" name="order_number" value="{{$advertisement->order_number}}" min="0" step="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-lg-1 col-sm-2">Image<span class="text-danger">*</span></label></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="file" name="photo" id="photo" accept="image/*" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contact" class="control-label col-lg-1 col-sm-2"></label>
                            <div class="col-lg-6 col-sm-8">
                                <img src="{{URL::asset('uploads/advertisements').'/'.$advertisement->photo}}" id="img" width="150" />
                            </div>
                        </div>
                        <?php $categories = DB::table('categories')->where('active',1)->orderBy('order', 'asc')->get();?>
                        <div class="form-group row">
                            <label for="contact" class="control-label col-lg-1 col-sm-2"></label>
                            <div class="col-lg-6 col-sm-8">
                            <select class="form-control" name="category" id="category"> 
                                @foreach($categories as $c)
                                    <option value="{{$c->id}}"​​ {{$c->id==$advertisement->category_id?'selected':''}}>{{$c->name}}</option>      
                                @endforeach 
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function loadFile(e){
        var output = document.getElementById('img');
        output.width = 150;
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script>
@endsection