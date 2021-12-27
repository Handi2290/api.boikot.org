<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg">

            <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-password-image"></div> -->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                                    <p class="mb-4">Silahkan masukan email anda di kolom berikut, link reset password akun anda akan kami kirim melalui email anda yang terdaftar.</p>
                                </div>
                                <form class="user" method="post" action="<?= base_url('auth/forgot_password') ?>>
                                    <div class=" form-group">
                                    <input type="email" class="form-control form-control-user" id="email" placeholder="Masukan email anda disini">
                            </div>
                            <button href="action=" <?= base_url() ?>" class="btn btn-primary btn-user btn-block">
                                Reset Password
                            </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/registration'); ?>">Buat Akun</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url(); ?>">Sudah Punya Akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>