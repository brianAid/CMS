<?= $this->extend('Template_admin') ?>

<?= $this->section('judul_halaman') ?> admin - beranda
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Vertically Centered Modal -->
<div class="col-lg-4 mb-3 col-md-6">
  <div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
      New caraousel
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Tambah caraousel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('admin/caraousel') ?>" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Foto</label>
                  <input type="file" class="form-control" name="foto" required />
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Judul</label>
                  <input type="text" class="form-control" name="judul" required />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Basic Bootstrap Table -->
<div class="card mb-3">
  <h5 class="card-header">Data Caraousel</h5>
</div>
<?php
if (!empty($caraousel)) {
  foreach ($caraousel as $us) {
    ?>
    <div class="mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?= base_url('assets/upload/caraousel/') . $us['foto'] ?>" alt="Foto Caraousel">
        <div class="card-body">
          <h5 class="card-title"><?= $us['judul'] ?></h5>
          <button type="button" class="btn btn-warning" onclick="editcaraousels(<?= $us['id_caraousel'] ?>)"
            data-bs-toggle="modal" data-bs-target="#modalEdit">
            Edit caraousel
          </button>
          <a href="<?= base_url('admin/caraousel/' . $us['id_caraousel']) ?>">
            <button type="button" class="btn btn-danger text-white">
              hapus
            </button>
          </a>
        </div>
      </div>
    </div>
    <tr>
      <td></td>
      <td>
      </td>
    </tr>
    <?php
  }
} ?>
<!--/ Basic Bootstrap Table -->

<!-- Vertically Centered Modal -->
<div class="col-lg-4 mb-3 col-md-6">
  <div class="mt-3">

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Edit caraousel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="editForm" action="<?= base_url('admin/caraousel') ?>" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label>Old Image</label>
                  <img id="oldImg" class="w-50" alt="">
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Foto</label>
                  <input type="file" id="imgForm2" name="foto" class="form-control" accept="image/png, image/jpeg">
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Judul</label>
                  <input type="text" class="form-control" name="judul" required />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  async function editcaraousels($id) {
    const form = document.getElementById('editForm');
    const OldImg = document.getElementById('oldImg');
    form.action = `<?= base_url('admin/caraousel/edit') ?>` + '/' + $id;
    try {
      const response = await fetch(`<?= base_url('json/caraousel') ?>` + '/' + $id);
      const caraousels = await response.json();
      console.log(caraousels);
      OldImg.src = `<?= base_url('assets/upload/caraousel') ?>` + '/' + caraousels['foto']
      form.judul.value = caraousels['judul'];
    } catch (error) {
      console.erEror('Error fetching caraousels:', error);
    }
  }
</script>
<?= $this->endSection() ?>