<x-root>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="">Detail Menu</h1>
        </div>
        
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-5">
                        <a href="{{ isset($foto[0]) ? asset('storage/'.$foto[0]->path) : 'https://placehold.co/400?text=image+cap' }}" data-fancybox="gallery" id="foto_menu">
                            <img src="{{ isset($foto[0]) ? asset('storage/'.$foto[0]->path) : 'https://placehold.co/400?text=image+cap' }}" class="img-fluid w-100" alt="">
                        </a>
                        <p class="mb-2 mt-4">Foto Menu</p>
                        <div class="row">
                            @foreach ($foto as $f)
                                <div class="col-3 mb-3">
                                    <a href="{{ asset('storage/'.$f->path) }}" class="foto-btn">
                                        <img src="{{ asset('storage/'.$f->path) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col ms-md-4">
                        <h1>{{ $menu->nama }}</h1>
                        <h4>Rp {{ number_format($menu->harga) }}</h4>
                        <p class="mt-4 mb-2 fw-bold">Kategori:</p>
                        @foreach ($kategori as $k)
                            <span class="badge text-bg-warning">{{ $k->kategori }}</span>
                        @endforeach
                        <div class="d-flex mt-3">
                            <div>
                                <img src="{{ $menu->foto ? asset('storage/'.$menu->foto) : 'https://placehold.co/40?text=PP'}}" alt="" class="rounded-circle" style="width: 50px">
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">{{ $menu->perusahaan ?? $menu->name }}</h5>
                                <p class="mb-0">{{ $menu->perusahaan ? $menu->name : '' }}</p>
                            </div>
                        </div>
                        <p><span class="fw-bold">Alamat:</span> {{ $menu->alamat }}</p>
                        <hr>
                        <p>{!! nl2br($menu->deskripsi) !!}</p>
                        @can('customer')
                            <a href="{{ route('pesan', $menu->id) }}" class="btn btn-warning">Pesan</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </x-layout>
</x-root>