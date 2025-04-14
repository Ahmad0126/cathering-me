<x-root>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="">Profil Anda</h1>
        </div>
        
        <div class="card shadow">
            <form action="{{ route('user_update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-4">
                                        <a href="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://placehold.co/400?text=profile' }}" data-fancybox="gallery">
                                            <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://placehold.co/400?text=profile' }}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="col-8">
                                        <label for="">Ubah</label>
                                        <input type="file" name="foto" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="name" id="nama" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <input type="text" id="role" class="form-control" value="{{ $user->role }}" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="name">Nama Perusahaan</label>
                                <input type="text" name="perusahaan" id="name" class="form-control" value="{{ $user->perusahaan }}">
                            </div>
                            <div class="mb-3">
                                <label for="harga">Nomor Telepon</label>
                                <input type="number" name="telepon" id="harga" class="form-control" value="{{ $user->telepon }}">
                            </div>
                            <div class="mb-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $user->alamat }}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Bio/Deskripsi</label>
                                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $user->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Simpan</button>
                </div>
            </form>
        </div>
        
    </x-layout>
</x-root>