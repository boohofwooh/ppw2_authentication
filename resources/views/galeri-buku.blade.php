@include('layout')
<section id="album" class="py-1 text-center bg-light">
    <div class="container">
        <h2>Buku: {{ $buku->judul }}</h2>
        <hr>
        <div class="row">
            @foreach($buku->galleries()->get() as $gallery)
            <div class="col-md-4">
                <a href="{{ asset($gallery->path) }}" data-lightbox="image-1" data_title="{{ $gallery->keterangan }}">
                    <img src="{{ asset($gallery->path) }}" style="width:200px; height:150px;"></a>
                    <p><h5>{{ $gallery->nama_galeri }}</h5></p>
            </div>
            @endforeach
        </div>
    </div>
</section>