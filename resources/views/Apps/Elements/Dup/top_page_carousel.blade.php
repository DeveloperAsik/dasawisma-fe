<!-- Start Carousel Area -->
<section class="section-gap carousel-area">
    <div class="overlay overlay-bg"></div>
    <div class="active-bottle-carousel">
        @if(isset($carousel) && !empty($carousel))
            @foreach($carousel AS $key => $values)
            <div class="item">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-md-4">
                            <div class="carousel-thumb">
                                <img src="{{ $_path_static_url . $values->images_cover }}" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-7">
                            <div class="carousel-content">
                                {!!$values->contents!!}
                                <a href="{{$_config_base_url}}/konten-detail/{{$values->id}}" class="primary-btn black">View More<span class="lnr lnr-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>
<!-- End Carousel Area -->