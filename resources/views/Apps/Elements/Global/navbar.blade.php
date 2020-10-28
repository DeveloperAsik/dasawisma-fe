<nav class="l-side-nav">
    <ul class="side-nav">
    @if(Request::segment(2) == null && $page == 'home')
        @if($_menu)
            @foreach($_menu AS $key => $value)
                @if($value['id'] == 1)
                    @php $active = 'is-active'; @endphp
                @else
                    @php $active = ''; @endphp
                @endif
                <li class="{{$active}}"><span>{{$value['name']}}</span></li>
            @endforeach
        @endif
    @elseif($page == 'about')
        <li class="is-active"><span>Kecamatan Bogor Timur</span></li>
        <li><span>Dasawisma</span></li>
        <li><span>Kegiatan</span></li>
    @elseif($page == 'dashboard-user')
        <li class="is-active"><span>Buat laporan </span></li>
        <li><span>Lihat data </span></li>
        <li><span>Unduh Laporan</span></li>
        <li><span>Profile</span></li>
    @endif
    </ul>
</nav>