<x-root>
    <x-slot:title>Daftar | KateringME</x-slot:title>
    <div class="container">
        <div class="row full align-items-center justify-content-center">
            <div class="col-4">
                <div class="card shadow">
                    <div class="card-body bg-dark text-light rounded">
                        <h3 class="text-warning text-center mb-5">Register</h3>
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="konfirmasi">Konfirmasi Password</label>
                                <input type="password" name="konfirmasi" id="konfirmasi" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Daftar sebagai</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" value="Customer" id="customer">
                                    <label class="form-check-label" for="customer">
                                        Customer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="role" value="Merchant" id="merchant">
                                    <label class="form-check-label" for="merchant">
                                        Merchant
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p>Sudah punya akun? <a href="/login" class="text-warning fw-bold text-decoration-none">Login</a></p>
                            </div>
                            <div class="mb-3 d-grid">
                                <button class="btn btn-block btn-warning" type="submit">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-root>
