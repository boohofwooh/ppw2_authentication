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
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tgl. Terbit</th>
            @if(Auth::check() && Auth::user() -> level == 'admin')
            <th colspan="2">Aksi</th></tr>
            @endif
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
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                @if(Auth::check() && Auth::user() -> level == 'admin')
                <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf 
                        <button onclick="return confirm('yakin mau dihapus?')" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
                <td><form action="{{ route('buku.edit', $buku->id) }}" method="get">
                        @csrf 
                        <button class="btn btn-primary">Edit</button>
                    </form>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<div>{{ $data_buku->links() }}</div>
<div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>
<p>Total Harga: {{ "Rp ".number_format($total_harga, 2, ',', '.' ) }}</p>
<a href="{{ route('buku.create') }}">Tambah Buku</a>
