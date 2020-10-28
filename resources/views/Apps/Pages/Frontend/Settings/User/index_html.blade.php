<ul class="l-main-content main-content">
    <li class="l-section section section--is-active">
        <div class="intro">
            @if(isset($_content_homepage) && !empty($_content_homepage)) 
            <div class="intro--banner">
                <h1>Selamat datang<br> di Dasawisma<br>Bogor<br>Timur</h1>
                <button class="cta" data-target_id="2" title='klik untuk lihat lebih lanjut...' style="width:200px">Tentang Dasawisma
                    <span class="btn-background"></span>
                </button>
                <img src="{{$_content_homepage->image_path}}" alt="{{$_content_homepage->title}}" />
            </div>
            <div class="intro--options">
                {!! $_content_homepage->content_unrender !!}
            </div>
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
        <div class="about">
            @if(isset($_about) && !empty($_about))
            <div class="about--banner">
                <h2>{!! str_replace(' ', '<br/>',$_about->title) !!}</h2>
                <a href="/tentang/kecamatan-bogor-timur" title='klik untuk lihat lebih lanjut...'>Dasawisma Kecamatan Bogor Timur
                    <span>
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                        <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                        <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z"/>
                        </g>
                        </svg>
                    </span>
                </a>
                <img src="{{url($_about->photo)}}" alt="{{$_about->title}}" />
            </div>
            <div class="about--options">
                <div style="margin:20px 0px 20px 0px; height:200px;width:100%; text-align: left;position: relative;padding:20px;">{!! $_about->description !!}</div>
            </div>
            @endif
        </div>
    </li>
    <li class="l-section section">
        <div class="contact">
            <div class="contact--lockup">
                <h2>Hubungi kami dengan meninggalkan pesan</h2>
                <div class="modal">
                    <div class="modal--information">
                        <small>Dasawisma kecamatan Bogor Timur</small>
                    </div>
                    <div class="modal--options">
                        <form class="request-contact-form">
                            <div class="information-email">
                                <label for="email">Surel</label><br/>
                                <input id="email" type="email" spellcheck="false" />
                            </div><br/>
                            <div class="information-name">
                                <label for="name">Nama Depan</label><br/>
                                <input id="fname" type="text" spellcheck="false">
                            </div><br/>
                            <div class="information-name">
                                <label for="name">Nama Belakang</label><br/>
                                <input id="lname" type="text" spellcheck="false">
                            </div><br/> 
                            <div class="information-name">
                                <label for="name">Pesan,Saran atau Kritik Anda</label><br/>
                                <textarea rows="4" name="content"></textarea>
                            </div><br/> 
                            <button type="submit" style="color:#282828">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="l-section section">
        <div class="hire">
            <h2>You want us to do</h2>
            <!-- checkout formspree.io for easy form setup -->
            <form class="work-request">
                <div class="work-request--options">
                    <span class="options-a">
                        <input id="opt-1" type="checkbox" value="app design" />
                        <label for="opt-1">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            App Design
                        </label>
                        <input id="opt-2" type="checkbox" value="graphic design" />
                        <label for="opt-2">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            Graphic Design
                        </label>
                        <input id="opt-3" type="checkbox" value="motion design">
                        <label for="opt-3">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            Motion Design
                        </label>
                    </span>
                    <span class="options-b">
                        <input id="opt-4" type="checkbox" value="ux design">
                        <label for="opt-4">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            UX Design
                        </label>
                        <input id="opt-5" type="checkbox" value="webdesign">
                        <label for="opt-5">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            Webdesign
                        </label>
                        <input id="opt-6" type="checkbox" value="marketing">
                        <label for="opt-6">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                            <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z"/>
                            </g>
                            </svg>
                            Marketing
                        </label>
                    </span>
                </div>
                <div class="work-request--information">
                    <div class="information-name">
                        <input id="name" type="text" spellcheck="false">
                        <label for="name">Name</label>
                    </div>
                    <div class="information-email">
                        <input id="email" type="email" spellcheck="false">
                        <label for="email">Email</label>
                    </div>
                </div>
                <input type="submit" value="Send Request" />
            </form>
        </div>
    </li>
    <li class="l-section section">
        <div class="login">
            <div class="login--lockup">
                <h2>Masuk ke akun dasawisma anda</h2>
                <div class="modal">
                    <div class="modal--information">
                        <small>Dasawisma kecamatan Bogor Timur</small>
                    </div>
                    <div class="modal--options">
                        <form class="request-contact-form">
                            <div class="information-name">
                                <label for="name">Surel/ID Kader/Nama Pengguna</label><br/>
                                <input id="fname" type="text" name="userid" spellcheck="false">
                                <span class="info-userid"></span>
                            </div><br/>
                            <div class="information-name">
                                <label for="name">Kata Sandi</label><br/>
                                <input id="password" name="password" type="text" spellcheck="false">
                                <span class="info-password"></span>
                            </div><br/> 
                            <div class="information-name">
                                <label for="name">Masukkan Ulang Kata Sandi</label><br/>
                                <input id="repassword" name="password2" type="text" spellcheck="false">
                                <span class="info-password2"></span>
                            </div><br/> 
                            <button type="submit" style="color:#282828;width:150px;">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>