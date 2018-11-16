@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Video List&nbsp;&nbsp;
                    <a href="{{url('/admin/video/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <form action="{{url('/admin/video')}}" class="form-inline" method="get">
                        <div class="col-md-6">
                        <br>
                            <input type="text" class="form-control" style="width:100%;" id="q" name="q" value="{{$query}}" >
                        </div>
                        <div class="col-1">
                        <br>
                            <button type="submit"   class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Featured Image</th>
                                <th>URL</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $pagex = @$_GET['page'];
                                if(!$pagex)
                                $pagex = 1;
                                $i = 18 * ($pagex - 1) + 1;
                            ?>
                            @foreach($videos as $vid)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{asset('uploads/videos/'.$vid->poster_image)}}" alt="" width='50'></td>
                                    
                                    <td>
                                        {{$vid->url}}
                                    </td>
                                    <td>
                                        <a href="{{url('admin/video/detail/'.$vid->id)}}">{{$vid->title}}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-info"  href="{{url('/admin/video/edit/'.$vid->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger"  href="{{url('/admin/video/delete/'.$vid->id ."?page=".@$_GET["page"])}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{$videos->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection