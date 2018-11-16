<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @if($video != null)
    <meta name="description" content="{{$video->title}}">
    <link rel="image_src" href="{{asset('uploads/videos/'.$video->poster_image)}}" width="100%" >
    @elseif($post != null)
    <meta name="description" content="{{$post->title}}">
    <link rel="image_src" href="{{asset('uploads/posts/'.$post->featured_image)}}" width="100%" >
    @else 
    <meta name="description" content="Soben 24 News">
    <link rel="image_src" href="{{asset('fronts/img/core-img/logo.png')}}" width="100%" >
    @endif
    <meta name="author" content="Sor Vichey">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Soben 24 News</title>
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="stylesheet" href="{{asset('fronts/css/style.css')}}">
</head>
<body>
    <?php 
        $menus = DB::table('categories')->where('active', 1)->orderBy('order', 'asc')->get();
    ?>
    <header class="header-area">
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="top-header-content d-flex align-items-center justify-content-between">
                            <div class="logo">
                                <a href="{{url('/')}}"><img src="{{asset('fronts/img/core-img/logo.png')}}" width="80" alt=""></a>
                            </div>
                            <div>
                            @if($advertisement !== null) 
                                <a href="{{$advertisement->url}}" target="_blank">
                                    <img src="{{asset('uploads/advertisements/'.$advertisement->photo)}}" alt="">
                                </a>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="newspaper-main-menu" id="stickyMenu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <nav class="classy-navbar justify-content-between" id="newspaperNav">
                        <div class="logo">
                            <a href="{{url('/')}}"><img src="{{asset('fronts/img/core-img/logo.png')}}" width="50" alt=""></a>
                        </div>
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <div class="classy-menu">
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <div class="classynav">
                                <ul>
                                    <li><a href="{{url('/')}}"><i class="fa fa-home"></i> ទំព័រមុខ</a></li>
									<li><a href="{{url('/video')}}"><i class="fa fa-youtube"></i> វីដេអូថ្មីៗ</a></li>
                                    @foreach($menus as $c)
                                        @if($c->id !== 6 && $c->id !== 5)
                                        <li><a href="{{url('post/category/'.$c->id)}}">{{$c->name}}</a></li>
                                        @endif
									@endforeach
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
	@yield('content')
    <footer class="footer-area">
        <div class="main-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-2">
                        <div class="footer-widget-area mt-30">
                            <div class="footer-logo">
                                <a href="{{url('/')}}"><img src="{{asset('fronts/img/core-img/logo.png')}}" width="80" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 col-lg-3">
                        <div class="footer-widget-area mt-30">
                            <ul class="list">
                                <li><a href="mailto:contact@youremail.com">អុីម៉ែល៖ info@akponline.com</a></li>
                                <li><a href="tel:+4352782883884">លេខទូរស័ព្ទ៖ ​+43 5278 2883 884</a></li>
                                <li><a href="http://yoursitename.com">អាសយដ្ឋាន៖ ​www.akp.gov.kh</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 col-lg-2">
                        <div class="footer-widget-area mt-30">
                            <h6 class="widget-title text-white">ជួបគ្នានៅបណ្តាញសង្គម</h6>
                            <a href="#"> <span class="social">  <i class="fa fa-facebook  fa-3x text-primary"></i></span></a>
                            <a href="#"> <span class="social">  <i class="fa fa-youtube fa-3x text-danger"></i></span></a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="bottom-footer-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 ">
                     
                        <p class="text-white">
                            &copy; រក្សា​សិទ្ធិ​គ្រប់​យ៉ាង​ដោយ​ ទីភ្នាក់ងារសារព័ត៌មានជាតិកម្ពុជា ឆ្នាំ​២០១៨  
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('fronts/js/jquery/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('fronts/js/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('fronts/js/plugins/plugins.js')}}"></script>
    <script src="{{asset('fronts/js/active.js')}}"></script>
    <script src="{{asset('fronts/js/jscroll-master/dist/jquery.jscroll.min.js')}}"></script>
    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<img class="center-block" src="{{asset('fronts/img/loading.gif')}}" alt="Loading..." />',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
</body>
</html>