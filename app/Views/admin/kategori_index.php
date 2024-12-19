<?= $this->extend('Template_admin') ?>

<?= $this->section('judul_halaman') ?> hmmm
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Vertically Centered Modal -->
<div class="col-lg-4 mb-3 col-md-6">
  <div class="mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
      New kategori
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Tambah kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= base_url('admin/kategori') ?>" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Kategori</label>
                  <input type="text" class="form-control" name="nama_kategori" required placeholder="Enter Kategori" />
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
<div class="card">
  <h5 class="card-header">Data Pengguna</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th>Kategori</th>
          <th width="10%">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php
        if (! empty($kategori)) {
          $no = 1;
          foreach ($kategori as $us) {
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $us['nama_kategori'] ?></td>
              <td>
                <button type="button" class="btn btn-warning" onclick="editkategoris(<?= $us['id_kategori'] ?>)"
                  data-bs-toggle="modal" data-bs-target="#modalEdit">
                  Edit kategori
                </button>
                <a href="<?= base_url('admin/kategori/' . $us['id_kategori']) ?>">
                  <button type="button" class="btn btn-danger text-white">
                    hapus
                  </button>
                </a>
              </td>
            </tr>
          <?php
          $no++;
        }
        } else { ?>
          <tr>
            <td colspan="4">
              <h1>Tidak ada kategori yang terdaftar.</h1>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<!-- Vertically Centered Modal -->
<div class="col-lg-4 mb-3 col-md-6"> 
  <div class="mt-3">

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Edit kategori</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="editForm" action="<?= base_url('admin/kategori') ?>" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label class="form-label">Kategori</label>
                  <input type="text" class="form-control" name="nama_kategori" required placeholder="Enter Kategori" />
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
  async function editkategoris($id) {
    const form = document.getElementById('editForm');
    form.action = `<?= base_url('admin/kategori/edit') ?>` + '/' + $id;
    try {
      const response = await fetch(`<?= base_url('json/kategori') ?>` + '/' + $id);
      const kategoris = await response.json();
      form.nama_kategori.value = kategoris['nama_kategori'];
    } catch (error) {
      console.erEror('Error fetching kategoris:', error);
    }
  }
</script>
<?= $this->endSection() ?>