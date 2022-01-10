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

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahCode">Tambah Cost Code</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Project</th>
                        <th class="text-center" scope="col">Induk</th>
                        <th class="text-center" scope="col">Cabang</th>
                        <th class="text-center" scope="col">Ranting</th>
                        <th class="text-center" scope="col">Uraian</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($code as $c) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td class="text-center"><?= $c['project']; ?></td>
                            <td class="text-center"><?= $c['induk']; ?></td>
                            <td class="text-center"><?= $c['cabang']; ?></td>
                            <td class="text-center"><?= $c['ranting']; ?></td>
                            <td class="text-center"><?= $c['uraian']; ?></td>
                            <td class="text-center">
                                <!-- <a href="<?= $c['id'] ?>" class="badge badge-warning" data-toggle="modal" data-target="#edit">Edit</a> -->
                                <a href="/costcode/delete/<?= $c['id'] ?>" class="badge badge-danger">Delete</a>
                            </td>
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
                <h5 class="modal-title" id="tambahCode">Tambah Cost Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('costcode') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="project" name="project" placeholder="Nomor Kode Project">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="induk" name="induk" placeholder="Nomor Kode Induk">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="cabang" name="cabang" placeholder="Nomor Kode Cabang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="ranting" name="ranting" placeholder="Nomor Kode Ranting">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="uraian" name="uraian" placeholder="Keterangan dari Nomor Kode">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit">Edit Cost Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/costcode/edit/<?= $c['id'] ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="project" name="project" placeholder="<?= $c['project']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="induk" name="induk" placeholder="<?= $c['induk']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="cabang" name="cabang" placeholder="<?= $c['cabang']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="ranting" name="ranting" placeholder="<?= $c['ranting']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control text-center" id="uraian" name="uraian" placeholder="<?= $c['uraian']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>