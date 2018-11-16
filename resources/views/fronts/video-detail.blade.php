@extends('layouts.front')
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area" style="background:#fff; padding: 0 15px; ">
                    <div class="single-blog-post featured-post single-post">
                        <div class="post-thumb">
                            <a href="#"><img src="img/bg-img/25.jpg" alt=""></a>
                        </div>
                        <div class="post-data">
                            <a href="#" class="post-title">
                                <h6>{{$video->title}}</h6>
                            </a>
                            <div class="post-meta row">
                                <div class="col-md-6">
                                <p class="post-author">កាលបរិច្ឆេទ ៖​​ 
                                    <span> 
                                        <?php
                                            $khmer_month = ['មករា','កុម្ភៈ',' មីនា','មេសា','ឧសភា','មិថុនា','កក្កដា','សីហា','កញ្ញា','តុលា','វិច្ឆិកា','ធ្នូ'];
                                            $months = date( "m", strtotime($video->create_at));
                                            $day = date( "d", strtotime($video->create_at));
                                            $year = date( "Y", strtotime($video->create_at));
                                            $time = date( "H:i", strtotime($video->create_at));
                                            if($time>12) {
                                                $time = $time.' PM';
                                            } else {
                                                $time = $time.' AM';
                                            }
                                        ?>
                                        {{$time}} - ថ្ងៃទី {{$day}} ខែ {{$khmer_month[(int)$months-1]}} ឆ្នាំ {{$year}}
                                    </span> 
                                    </div>
                                    <div class="col-md-6">
                                   
                                    <span class="float-right">
                                    ចែករំលែក ៖​
                                        <ul class="rrssb-buttons">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url('video/detail/'.$video->id)}}"  class="popup">
                                                <span style="color:#4267b2;" class="fa fa-2x fa-facebook-official"></span>
                                            </a>
                                            <a href="https://twitter.com/intent/tweet?text={{url('video/detail/'.$video->id)}}"
                                            class="popup">
                                            <span style="color:#00aced;" class="fa fa-2x text-info fa-twitter"></span>
                                            </a>
                                            <a href="mailto:?Subject={{$video->title}}&amp;body={{url('video/detail/'.$video->id)}}">
                                                <span class="fa fa-google-plus text-danger fa-2x"></span>
                                            </a>
                                        </ul>
<!-- Buttons end here -->               </div>
                                    </span>
                                </p>
                                <div class="col-md-12">
                                    <div class="youtube-video">
                                        <iframe  src="{{$video->url}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="col-md-12"><br>
                                    {!!$video->description!!} 
                                </div>
                                </div>
                            </div>
                        </div>
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
                    <!-- Latest Posts Widget -->
                    <div class="latest-posts-widget mb-15">
                    <div class="single-blog-post small-featured-post  shadow-sm p-3 bg-light rounded">
                        <div class="title-news">
                            អត្ថបទថ្មី
                        </div>
                        <hr class="hr1">
                    </div>
                        <!-- Single Featured Post -->
                        @foreach($lested_news as $n)
                        <div class="single-blog-post small-featured-post  shadow-sm p-3 bg-light rounded">
                            <div class="row">
                                <div class="col-md-4 col-4 padding-right-0">
                                    <a href="{{url('post/detail/'.$n->id)}}">
                                        <img src="{{asset('uploads/posts/small/'.$n->featured_image)}}" alt="">
                                    </a>
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