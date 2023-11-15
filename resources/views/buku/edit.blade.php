@include("layout")
<div class="container">
<h4>Edit Buku</h4>
<form action="{{route('buku.update',$buku->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input class="form-control" type="text" name="judul" id="judul" value="{{$buku->judul}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input class="form-control" type="text" name="penulis" id="penulis" value="{{$buku->penulis}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input class="form-control" type="text" name="harga" id="harga" value="{{$buku->harga}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Terbit</label>
        <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit" value="{{$buku->tgl_terbit}}">
    </div>
    <div class="mb-3">
        <label class="form-label">Thumbnail</label>
        <input class="form-control" type="file" name="thumbnail" id="thumbnail">
    </div>
    <div class="mb-3">
        <label class="form-label">Gallery</label>
        <div id="file-inputs">
            <input class="form-control" type="file" name="gallery[]" id="gallery">
        </div>
        <div id="tambahGallery">
        </div>
    </div>
    <br>
    <button type="button" class="btn btn-info" style="color: white" onclick="tambahData()">Tambah Gallery</button>
    <br>
    <div class="d-flex justify-content-end" style="gap: 15px">
        <button href="/buku" class="btn btn-danger">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>
    </div>
    <br>
    <br>
    <div id="gallery_items">
        @foreach($buku->galleries()->get() as $gallery)
        <div class="gallery_item">
            <img
            class="rounded-full object-cover object-center"
            src="{{ asset($gallery->path) }}"
            alt=""
            width="400"
            />
            <a class="btn btn-danger" href="{{ route('hapusGambarGallery', ['id' => $gallery->id]) }}" onclick="hapusGallery()">Hapus</a>
        </div>
        @endforeach
    </div>

    <script>
        function tambahData() {
            var container = document.getElementById("tambahGallery");
            container.innerHTML += '<input type="file" name="gallery[]" class="form-control" id="gallery"><br>';
        }
    </script>
</form>
</div>