<div class="container">
<h4>Edit Buku</h4>
<form action="{{route('buku.update',$buku->id)}}" method="POST">
    @csrf
    <div>Judul
        <input type="text" name="judul" id="judul" value="{{$buku->judul}}">
    </div>
    <div>Penulis
        <input type="text" name="penulis" id="penulis" value="{{$buku->penulis}}">
        
    </div>
    <div>Harga
        <input type="text" name="harga" id="harga" value="{{$buku->harga}}">
    </div>
    <div>Tgl. Terbit
        <input type="date" name="tgl_terbit" id="tgl_terbit" value="{{$buku->tgl_terbit}}">
    </div>
    <div><button type="submit">Simpan</button></div>
    <a href="/buku"> Batal</a>
</form>
</div>