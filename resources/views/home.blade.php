<x-root>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-layout>
        <h1 class="mb-5">Selamat Datang, {{ Auth::user()->name }}</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="">Daftar Menu</h4>
            <button class="btn btn-warning h-100" type="button" id="tambah">Filter</button>
        </div>
        <div class="row">
            @foreach ($menu as $i => $m)
                <div class="col-12 col-sm-6 col-xl-4 col-xxl-3 mb-3">
                    <div class="card shadow">
                        <img src="{{ $m->path ? asset('storage/'.$m->path) : 'https://placehold.co/400?text=image+cap'}}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="">
                        <div class="card-body bg-dark text-white rounded-bottom">
                            <h4>{{ $m->nama }}</h4>
                            @foreach ($kate[$i] as $k)
                                <span class="badge text-bg-warning">{{ $k->kategori }}</span>
                            @endforeach
                            <p>Rp {{ number_format($m->harga) }}</p>
                            <div class="d-flex my-3">
                                <div>
                                    <img src="{{ $m->foto ? asset('storage/'.$m->foto) : 'https://placehold.co/40?text=PP'}}" alt="" class="rounded-circle" style="width: 50px">
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ $m->perusahaan ?? $m->name }}</h5>
                                    <p class="mb-0">{{ $m->perusahaan ? $m->name : '' }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('detail', $m->id) }}" class="btn btn-warning">Detail</a>
                                @can('customer')
                                    <a href="{{ route('pesan', $m->id) }}" class="btn btn-outline-warning">Pesan</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade" id="menu_form" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('filter') }}" method="get">
                        <div class="modal-body">
                            <div class="mb-3">
                                <a class="d-block link-body-emphasis text-decoration-none text-dark" data-bs-toggle="collapse" href="#kategori" role="button">
                                    Kategori +
                                </a>
                                <div class="collapse" id="kategori">
                                    @foreach ($kategori as $k)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="kategori[]" value="{{ $k->id }}" id="kategori{{ $k->id }}">
                                            <label class="form-check-label" for="kategori{{ $k->id }}">
                                                {{ $k->kategori }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <select name="harga_operator" id="" class="form-control">
                                        <option value=">">Lebih Dari</option>
                                        <option value="<">Kurang Dari</option>
                                        <option value="=">Sama Dengan</option>
                                    </select>
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi">Lokasi</label>
                                <input name="lokasi" id="" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Terapkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-layout>
</x-root>