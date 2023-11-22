@include('layout')
@if(Session::has('pesan'))
    <div class="alert alert-success">{{Session::get('pesan')}}</div>
@endif
<form action="{{ route('buku.search') }}" method="get">
    @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari..." style="width: 30%; display:inline; margin-top: 10px; margin-bottom: 10px; float:right;">
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Thumbnail</th>
            <th>Judul Buku</th>
    </thead>
    <tbody>
        @foreach($data_buku as $buku)
            <tr>
                <td>{{ ++$no}}</td>
                <td>
                    @if ($buku->filepath)
                    <div class="relative h-10 w-10">
                        <img
                        class="h-full w-full object-cover object-center"
                        src="{{ asset($buku->filepath)}}"
                        alt=""
                        />
                    </div>
                    @endif
                </td>
                <td><a href="{{ route('galeri.buku', $buku->id) }}">{{ $buku->judul }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div>{{ $data_buku->links() }}</div>
<div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>