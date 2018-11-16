@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Edit Gift&nbsp;&nbsp;
                    <a href="{{url('/admin/gift')}}" class="btn btn-link btn-sm">Back To List</a>
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

                    <form action="{{url('/admin/gift/update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$gift->id}}" name="id">
                        <div class="form-group row">
                            <label for="code" class="control-label col-lg-2 col-sm-2">Code <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="text" required autofocus name="code" value="{{$gift->code}}" id="code" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="top_up_number" class="control-label col-lg-2 col-sm-2">Number 14 digits<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" name="top_up_number" value="{{$gift->top_up_number}}" id="top_up_number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount" class="control-label col-lg-2 col-sm-2">Amount $ <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="number" name="amount" value="{{$gift->amount}}" id="amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="control-label col-lg-2 col-sm-2">Type <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                              <select name="type" class="form-control" id="type">
                                <option value="smart" {{$gift->type=='smart'?'selected':''}}>Smart</option>
                                <option value="cellcard" {{$gift->type=='cellcard'?'selected':''}}>Cellcard</option>
                                <option value="metfone" {{$gift->type=='metfone'?'selected':''}}>Metfone</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dateline" class="control-label col-lg-2 col-sm-2">Dateline <span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <input type="date" name="dateline" id="dateline" value="{{$gift->dateline}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-8">
                                <button class="btn btn-primary" type="submit">Save</button>
                                <button class="btn btn-danger" type="reset">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection