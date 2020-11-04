<ul class="l-main-content main-content">
    <li class="l-section section section--is-active">
        <div class="create">
            <div class="create--lockup">
                <div class="modal">
                    <div class="modal--information">
                        <h3>Buat Laporan Kejadian</h3>
                    </div>
                    <div class="modal--options">
                        <form class="request-contact-form">
                            <div class="col col-md-12">
                                <div class="tab">
                                    <button class="tablinks" data-id="page1" id="defaultOpen" >Judul Laporan</button>
                                    <button class="tablinks" data-id="page2" >Lokasi Laporan</button>
                                    <button class="tablinks" data-id="page3" >Deskripsi Kejadian</button>
                                </div>
                                <div id="page1" class="tabcontent">
                                    <div class="col col-md-12">
                                        <label for="name">Judul Laporan</label><br/>
                                        <input id="fname" type="text" name="userid" spellcheck="false">
                                        <span class="info-userid"></span>
                                    </div>
                                    <div class="information-name col col-md-4">
                                        <label for="name">Tipe</label><br/>
                                        <select>
                                            <option>-- pilih satu --</option>
                                            @if($types)
                                                @foreach($types AS $key => $values)
                                                    <option value="{{ $values->id}}">{{ $values->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                    <div class="information-name col col-md-4">
                                        <label for="name">Level</label><br/>
                                        <select>
                                            <option>-- pilih satu --</option>
                                            @if($level)
                                                @foreach($level AS $key => $values)
                                                    <option value="{{ $values->id}}">{{ $values->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                </div>
                                <div id="page2" class="tabcontent">
                                    <div class="information-name col col-md-3">
                                        <label for="name">Provinsi</label><br/>
                                        <select name="province" class="province">
                                            <option value="0">-- pilih satu --</option>
                                            @if($provinces)
                                                @foreach($provinces AS $key => $values)
                                                    <option value="{{ $values->id}}">{{ $values->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                    <div class="information-name col col-md-3">
                                        <label for="name">Kota</label><br/>
                                        <select name="city" class="city">
                                            <option value="0">-- Pilih Provinsi terlebih dahulu --</option>
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                    <div class="information-name col col-md-3">
                                        <label for="name">Kecamatan</label><br/>
                                        <select name="district" class="district">
                                            <option value="0">-- Pilih kota terlebih dahulu --</option>
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                    <div class="information-name col col-md-3">
                                        <label for="name">Kelurahan</label><br/>
                                        <select name="sub_district" class="sub_district">
                                            <option value="0">-- Pilih kecamatan terlebih dahulu --</option>
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                    <div class="information-name col col-md-3">
                                        <label for="name">Posyandu Terdekat</label><br/>
                                        <select name="service_post" class="service_post">
                                            <option value="0">-- Pilih kelurahan terlebih dahulu --</option>
                                        </select>
                                        <span class="info-password"></span>
                                    </div>
                                </div>
                                <div id="page3" class="tabcontent">
                                    <div class="col col-md-12">
                                        <label for="name">Alamat lengkap Kejadian</label><br/>
                                        <textarea cols="40"></textarea>
                                        <span class="info-password"></span>
                                    </div>
                                    
                                    <div class="col col-md-12">
                                        <label for="name">Deskripsi</label><br/>
                                        <textarea id="ckeditor" rows="10"></textarea>
                                        <span class="info-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="information-name col col-md-12">
                                <button type="submit" style="color:#282828;width:150px;">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="l-section section">
        <div class="search">
            <div class="search--lockup">
                <div class="modal">
                    <div class="modal--information">
                        <h3>Pencarian Laporan Kejadian</h3>
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
                            <button type="submit" style="color:#282828;width:150px;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="l-section section">
        <div class="download">
            <div class="download--lockup">
                <div class="modal">
                    <div class="modal--information">
                        <h3>Unduh Laporan Kejadian</h3>
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
                            <button type="submit" style="color:#282828;width:150px;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li class="l-section section">
        <div class="profile">
            <div class="profile--lockup">
                <div class="modal">
                    <div class="modal--information">
                        <h3>Detail Data pengguna Aplikasi</h3>
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
                            <button type="submit" style="color:#282828;width:150px;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>