<x-root>
    <x-slot:title>Reset Password | KateringME</x-slot:title>
    <div class="full">
        <div class="row full align-items-center justify-content-center">
            <div class="col-11 col-xxl-3 col-xl-4 col-md-6">
                <div class="card shadow">
                    <div class="card-body bg-dark text-light rounded">
                        <h3 class="text-warning text-center mb-5">Reset Password</h3>
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="password">Password Baru</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi">Password</label>
                                <input type="password" name="konfirmasi" id="konfirmasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <p>Kembali ke <a href="/" class="text-warning fw-bold text-decoration-none">Home</a></p>
                                
                            </div>
                            <div class="mb-3 d-grid">
                                <button class="btn btn-block btn-warning" type="submit">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-root>