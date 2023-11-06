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
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                @if(Auth::check() && Auth::user() -> level == 'admin')
                <td>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                        @csrf 
                        <button onclick="return confirm('yakin mau dihapus?')">Hapus</button>
                    </form>
                </td>
                <td><form action="{{ route('buku.edit', $buku->id) }}" method="get">
                        @csrf 
                        <button>Edit</button>
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
