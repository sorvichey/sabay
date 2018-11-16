
@extends('layouts.front')
@section('content')  
<div class="frame-content container">
    <?php $last_video = DB::table('videos')->where('active', 1)->orderBy('id', 'desc')->first();?>
    <div class="container py-3">
        <div class="row">
            <div class="pb-4 col-md-7">
                <iframe class="last_video"  src="{{$last_video->url}}" frameborder="0"></iframe>
            </div>
        <div class="col-md-5">
            <p><strong>វាយលេខពី 00 - 99 អ្នកមានឪកាសឈ្នះ 1$</strong></p>
            <p><strong>វាយលេខពី​ 000 - 999 អ្នកមានឪកាសឈ្នះ 5$</strong></p>
            <p><strong>វាយលេខពី ​0000 - 9999 អ្នកមានឪកាសឈ្នះ 50$</strong></p>
            <img src="{{asset('fronts/img/core-img/smart.png')}}" width="100" alt="">
            <form action="{{url('/gift')}}" method="get">
                <div class="row py-2">
                    <div class="col-md-6"><input type="submit" class="btn btn-success btn-block" value="Smart"></div>
                    <div class="col-md-6"><input type="text" class="form-control" placeholder="សូមវាយបញ្ជលលេខនៅទីនេះ" name="smart"></div>
                </div>
            </form>
            <img src="{{asset('fronts/img/core-img/cellcard.png')}}" width="100" alt="">
            <form action="{{url('/gift')}}"  method="get">
                <div class="row py-2">
                    <div class="col-md-6"><input type="submit" class="btn btn-warning btn-block text-white" value="Cellcard"></div>
                    <div class="col-md-6"><input type="text" class="form-control"  placeholder="សូមវាយបញ្ជលលេខនៅទីនេះ"​name="cellcard"></div>
                </div> 
            </form>
            <img src="{{asset('fronts/img/core-img/metfone.png')}}" width="100" alt="">
            <form action="{{url('/gift')}}" method="get">
                <div class="row py-2">
                    <div class="col-md-6"><input type="submit" class="btn btn-info btn-block" value="metfone"></div>
                    <div class="col-md-6"><input type="text" class="form-control"​ placeholder="សូមវាយបញ្ជលលេខនៅទីនេះ" name="metfone"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="featured-post-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="section-heading">
                    <p>វីដេអូថ្មីៗ</p>
                </div><br>
                <!-- Single Featured Post -->
                @foreach($videos as $v)
                <?php
                    $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                    $months = date( "m", strtotime($v->create_at));
                    $day = date( "d", strtotime($v->create_at));
                    $year = date( "Y", strtotime($v->create_at));
                    $time = date( "H:i", strtotime($v->create_at));
                    if($time>12) {
                        $time = $time.' PM';
                    } else {
                        $time = $time.' AM';
                    }
                ?>
               <div class="single-blog-post small-featured-post  shadow-sm p-3  bg-light rounded">
                <div class="row">
                    <div class="col-md-5 padding-right-0">
                        <a href="{{url('/video/detail/'.$v->id)}}">
                            <img src="{{asset('uploads/videos/small/'.$v->poster_image)}}" alt="">
                        </a>
                    </div>
                        <div class="post-meta col-md-7">
                        <div class="post-data">
                        <a href="{{url('/video/detail/'.$v->id)}}" class="post-catagory">{{$v->title}}</a>
                    </div>
                            <a href="{{url('/video/detail/'.$v->id)}}" class="post-title">
                                <h6>{!!$v->short_description!!}</h6>
                            </a>
                            <small>{{$time}} - ថ្ងៃទី {{$day}} ខែ {{$khmer_month[(int)$months-1]}} ឆ្នាំ {{$year}}</small>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                <br>
                <div class="col-md-12 mb-5">
                    <a href="{{url('video')}}" class="btn btn-primary btn-sm float-right">ព័ត៌មានវីដេអូ /  អានបន្តែម <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>      
            <?php 
                $i = 1;
                $categories = DB::table('categories')->where('active', 1)->orderBy('order', 'asc')->get();
            ?>
            <div class="col-12 col-md-6 col-lg-6">
                    @foreach($categories as $c)
                    @if($c->id !== 6 && $c->id !== 5)
                    <div class="section-heading{{$i++}}">
                        <p>{{$c->name}}</p>
                    </div><br>  
                    @endif
                    <?php $posts = DB::table('posts')->where('active',1)->where('category_id', $c->id)->orderBy('id', 'desc')->limit('5')->get(); ?>
                    @foreach($posts as $p)
                            <?php
                            $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                            $months = date( "m", strtotime($p->create_at));
                            $day = date( "d", strtotime($p->create_at));
                            $year = date( "Y", strtotime($p->create_at));
                            $time = date( "H:i", strtotime($p->create_at));
                            if($time>12) {
                                $time = $time.' PM';
                            } else {
                                $time = $time.' AM';
                            }
                        ?>
                    <div class="single-blog-post small-featured-post  shadow-sm p-3  bg-light rounded">
                        <div class="row">
                                <div class="post-meta col-md-7">
                                    <div class="post-data">
                                        <a href="{{url('post/detail/'.$p->id)}}" class="post-catagory">{{$p->title}}</a>
                                    </div>
                                        <a href="{{url('post/detail/'.$p->id)}}" class="post-title">
                                            <h6>{{$p->short_description}}</h6>
                                        </a>
                                        <small>{{$time}} - ថ្ងៃទី {{$day}} ខែ {{$khmer_month[(int)$months-1]}} ឆ្នាំ {{$year}}</small>
                                    </div>
                                    <div class="col-md-5 padding-left-0">
                                        <a href="{{url('post/detail/'.$p->id)}}">
                                            <img src="{{asset('uploads/posts/small/'.$p->featured_image)}}" alt="">
                                       </a>
                                    </div>
                                </div>
                        </div>
                        <br>
                    @endforeach
                    @if($c->id !== 6 && $c->id !== 5)
                    <br>
                    <div class="col-md-12 mb-5">
                        <a href="{{url('post/category/'.$c->id)}}" class="btn btn-primary btn-sm float-right"> {{$c->name}} / អានបន្តែម <i class="fa fa-arrow-right"></i></a>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
 @endsection
   