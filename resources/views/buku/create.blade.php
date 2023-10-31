@include('layout')
<div class="container">
<h4>Tambah Buku</h4>
@if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<form action="{{route('buku.store')}}" method="POST">
    @csrf
    <div>Judul
        <input type="text" name="judul" id="judul">
    </div>
    <div>Penulis
        <input type="text" name="penulis" id="penulis">
    </div>
    <div>Harga
        <input type="text" name="harga" id="harga">
    </div>
    <div>Tgl. Terbit
        <input type="text" name="tgl_terbit" id="tgl_terbit" class="date form-control" placeholder="yyyy/mm/dd">
    </div>
    <div><button type="submit">Simpan</button></div>
    <a href="/buku"> Batal</a>
</form>
</div>
