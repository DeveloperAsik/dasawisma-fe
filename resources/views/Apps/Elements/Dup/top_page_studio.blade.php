<!-- Start studio Area -->
<section class="section-gap studio-area">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4 col-sm-6 text-center">
                <div class="studio-thumb">
                    <img src="img/s.jpg" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-8 col-sm-6">
                <div class="studio-content">
                    @if($_about)
                    <h2>{{$_about->title}}</h2>
                    {!!$_about->description!!}
                    <a href="{{$_about->link_homepage}}" class="primary-btn">View More<span class="lnr lnr-arrow-right"></span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End studio Area -->