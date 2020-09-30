<nav class="l-side-nav">
    <ul class="side-nav">
    @if(Request::segment(2) == null)
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
    @else
        <li class="is-active"><span>Kecamatan Bogor Timur</span></li>
        <li><span>Dasawisma</span></li>
        <li><span>Kegiatan</span></li>
    @endif
    </ul>
</nav>