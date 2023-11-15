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
<form action="{{route('buku.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input class="form-control" type="text" name="judul" id="judul">
    </div>
    <div class="mb-3">
        <label class="form-label">Penulis</label>
        <input class="form-control" type="text" name="penulis" id="penulis">
    </div>
    <div class="mb-3">
        <label class="form-label">Harga</label>
        <input class="form-control" type="text" name="harga" id="harga">
    </div>
    <div class="mb-3">
        <label class="form-label">Tanggal Terbit</label>
        <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit">
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

    <script>
        function tambahData() {
            var container = document.getElementById("tambahGallery");
            container.innerHTML += '<input type="file" name="gallery[]" class="form-control" id="gallery"><br>';
        }
    </script>
</form>
</div>
