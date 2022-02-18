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

            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $code['id'];?>">
                <div class="form-group row">
                    <label for="project" class="col-sm-2 col-form-label">Project</label>
                    <div class="col-sm-10">
                        <input type="text" id="project" name="project" autofocus value="<?= $code['project'] ?>">
                    </div>
                    <label for="induk" class="col-sm-2 col-form-label">Induk</label>
                    <div class="col-sm-10">
                        <input type="text" id="induk" name="induk" autofocus value="<?= $code['induk'] ?>">
                    </div>
                    <label for="cabang" class="col-sm-2 col-form-label">Cabang</label>
                    <div class="col-sm-10">
                        <input type="text" id="cabang" name="cabang" autofocus value="<?= $code['cabang'] ?>">
                    </div>
                    <label for="ranting" class="col-sm-2 col-form-label">Ranting</label>
                    <div class="col-sm-10">
                        <input type="text" id="ranting" name="ranting" autofocus value="<?= $code['ranting'] ?>">
                    </div>
                    <label for="Uraian" class="col-sm-2 col-form-label">Uraian</label>
                    <div class="col-sm-10">
                        <input type="text" id="uraian" name="uraian" autofocus value="<?= $code['uraian'] ?>">
                    </div>
                </div>
            </form>

            <div>
                <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>

</div>

</div>