<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Tanggal</th>
                        <th class="text-left" scope="col">Nominal</th>
                        <th class="text-center" scope="col">Uraian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($detail as $d) : ?>
                        <tr>
                            <th scope="row" class="text-center"><?= $i; ?></th>
                            <td class="text-center"><?= $d['cr_tanggal']; ?></td>
                            <td class="text-left">Rp. <?= number_format($d['cr_dtl_nominal']); ?></td>
                            <td class="text-center"><?= $d['cr_uraian']; ?></td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="tambahCode" tabindex="-1" role="dialog" aria-labelledby="tambahCodeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahCode">Buat CR Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('transaksi') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="cr_no_hdr" name="cr_no_hdr" placeholder="Nomor CR">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="cr_foto" name="cr_foto" placeholder="Upload Foto">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="cr_tanggal" name="cr_tanggal" placeholder="Tanggal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Lanjutkan</button>
                </div>
            </form>
        </div>
    </div>
</div>