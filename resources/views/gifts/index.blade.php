@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Gift List&nbsp;&nbsp;
                    <a href="{{url('/admin/gift/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Code</th>
                                <th>Amount $</th>
                                <th>Number 14 digits</th>
                                <th>Type</th>
                                <th>Dateline</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($gifts as $cat)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$cat->code}}</td>
                                <td>{{$cat->amount}} $</td>
                                <td>{{$cat->top_up_number}}</td>
                                <td>{{$cat->type}}</td>
                                <td>{{$cat->dateline}}</td>
                                <td>
                                    <a class="btn btn-info btn-xs" href="{{url('/admin/gift/edit/'.$cat->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="{{url('/admin/gift/delete/'.$cat->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                    {{$gifts->links()}}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection