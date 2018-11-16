@extends('layouts.front')
@section('content')
<br>
<div class="featured-post-area">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="section-heading{{$category->id}}">
                    <p>{{$category->name}}</p>
                </div><br>
                <div class="col-md-12  shadow-sm p-3">
                <div class="row">
                @foreach($last_posts as $v)
                <?php
                    $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                    $months = date( "m", strtotime($v->create_at));
                    $day = date( "d", strtotime($v->create_at));
                    
                    $time = date( "H:i", strtotime($v->create_at));
                    if($time>12) {
                        $time = $time.' PM';
                    } else {
                        $time = $time.' AM';
                    }
                ?>
                <div class="single-blog-post  padding-right-0 padding-left-0 col-md-6">
                    <div class="col-md-12">
                        <a href="{{url('post/detail/'.$v->id)}}"> 
                            @if($v->featured_image)
                            <img src="{{asset('uploads/posts/small/'.$v->featured_image)}}" alt="">
                            @else 
                            <img src="{{asset('fronts/img/default.jpg')}}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="post-meta col-md-12">
                        <div class="post-data">
                            <a href="{{url('post/detail/'.$v->id)}}" class="post-catagory">{{$v->title}}</a>
                        </div> 
                    </div>
                </div>
                @endforeach
                </div> </div><br>
                <div class="infinite-scroll">
                    @foreach($posts as $v)
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
                <div class="single-blog-post small-featured-post  shadow-sm p-3 bg-light rounded">
                    <div class="row">
                        <div class="col-md-4 padding-right-0">
                            <a href="{{url('post/detail/'.$v->id)}}"><img src="{{asset('uploads/posts/small/'.$v->featured_image)}}" alt=""></a>
                        </div>
                            <div class="post-meta col-md-8">
                                <div class="post-data">
                                    <a href="{{url('post/detail/'.$v->id)}}" class="post-catagory">{{$v->title}}</a>
                                    <hr>
                            </div>
                                <a href="{{url('post/detail/'.$v->id)}}" class="post-title">
                                    <h6>{{$v->short_description}}</h6>
                                </a>
                                <small>{{$time}} - ថ្ងៃទី {{$day}} ខែ {{$khmer_month[(int)$months-1]}} ឆ្នាំ {{$year}}</small>
                            </div>
                        </div>
                    </div>
                    <br>
                    @endforeach
                    {{$posts->links()}}
                </div>
            </div>
            <?php $lested_news = DB::table('posts')->where('active', 1)->orderBy('id', 'desc')->limit('5')->get(); ?>
                <div class="col-12 col-lg-4">
                @foreach($advertisement_right as $r)
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="{{$r->url}}" target="_blank">
                            <img src="{{asset('uploads/advertisements/'.$r->photo)}}" width="100%" alt="">
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="blog-sidebar-area">                      
                <div class="latest-posts-widget mb-15">
                <div class="single-blog-post small-featured-post  shadow-sm p-3 bg-light rounded">
                    <div class="title-news">
                        អត្ថបទថ្មី
                    </div>
                    <hr class="hr1">
                </div>
                    @foreach($lested_news as $n)
                    <div class="single-blog-post small-featured-post  shadow-sm p-3 bg-light rounded">
                        <div class="row">
                            <div class="col-md-4 col-4 padding-right-0">
                                <a href="{{url('post/detail/'.$n->id)}}"><img src="{{asset('uploads/posts/small/'.$n->featured_image)}}" alt=""></a>
                            </div>
                                <div class="post-meta col-8 col-md-8">
                                    <div class="post-data">
                                        <a href="{{url('post/detail/'.$n->id)}}" class="post-catagory">{{$n->title}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    @endforeach
                </div>
                @foreach($advertisement_right_bottom as $r)
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="{{$r->url}}" target="_blank">
                            <img src="{{asset('uploads/advertisements/'.$r->photo)}}" width="100%" alt="">
                        </a>
                    </div>
                </div>
                @endforeach
            </div> 
        </div>
    </div>
</div>
<br>
@endsection