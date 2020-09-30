
<ul class="l-main-content main-content">
    <li class="l-section section section--is-active">
        <div class="intro">
            @if(isset($_about) && !empty($_about)) 
                <div class="intro--banner">
                    <h1>{!! str_replace(' ','<br/>',$_about->title) !!}</h1>
                    <button class="cta" data-target_id="2" style="width:200px">Tentang Dasawisma
                        <span class="btn-background"></span>
                    </button>
                    <img src="{{$_about->photo}}" alt="{{$_about->title}}" />
                </div>
                <div class="intro--options">
                    {!!$_about->description!!}
                </div>
                <a href="{!!$_about->website!!}">Website Kota Bogor</a> 
            @endif
        </div>
    </li>
    <li class="l-section section">
        <div class="work">
            <div class="work--lockup">
                <ul class="slider">
                    @if(isset($carousel) && !empty($carousel))
                    @php $position = 'left'; @endphp
                    @php $i=1; @endphp
                        @foreach($carousel AS $key => $value)
                        @php
                            if($i == 1){
                                $position = 'left';
                            }elseif($i == 2){
                                $position = 'center';
                            }else{
                                $position = 'right';
                            }
                        @endphp
                            <li class="slider--item slider--item-{{$position}}">
                                <a class="cta" data-target_id="2" href="#">
                                    <div class="slider--item-image">
                                        <img src="{{ $_path_images . $value->image_path }}" alt="{{ $value->title }}">
                                    </div>
                                    <p class="slider--item-title">{{ $value->title }}</p>
                                </a>
                            </li>
                        @php $i++; @endphp
                        @php if($i==4) $i=1; @endphp
                        @endforeach
                    @endif
                    
                </ul>
                <div class="slider--prev">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                    <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                    <path d="M561,1169C525,1155,10,640,3,612c-3-13,1-36,8-52c8-15,134-145,281-289C527,41,562,10,590,10c22,0,41,9,61,29
                          c55,55,49,64-163,278L296,510h575c564,0,576,0,597,20c46,43,37,109-18,137c-19,10-159,13-590,13l-565,1l182,180
                          c101,99,187,188,193,199c16,30,12,57-12,84C631,1174,595,1183,561,1169z"/>
                    </g>
                    </svg>
                </div>
                <div class="slider--next">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                    <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                    <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z"/>
                    </g>
                    </svg>
                </div>
            </div>
        </div>
    </li>
    <li class="l-section section">
        <div class="about is-vis">
            @if(isset($carousel) && !empty($carousel))
                <div style='width:100%; height:640px; font-size: 12px; overflow: auto;margin: 50px 0px 0px 0px;'>
                    @foreach($carousel AS $key => $value)
                        <h2>{{$value->title}}</h2>
                        <div>{!!$value->content_unrender!!}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </li>
</ul>