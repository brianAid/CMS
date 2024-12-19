<?= $this->extend('Template_admin') ?>

<?= $this->section('judul_halaman') ?> hmmm
<?= $this->endSection() ?>
<?= $this->section('content') ?>
  <!-- Vertically Centered Modal -->
  <div class="col-lg-4 mb-3 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
        New user
      </button>

      <!-- Modal -->
      <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Tambah User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/user') ?>" method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="Nama" required placeholder="Enter Nama" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="Username" required placeholder="Enter Username" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="Password" required placeholder="Enter Password" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Level</label>
                    <select class="form-control" name="level">
                      <option value="Admin">Admin</option>
                      <option value="Kontributor">Kontributor</option>
                    </select>
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
            <th>Username</th>
            <th>Nama</th>
            <th>Level</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php
          if (!empty($user)) {
            foreach ($user as $us) {
              ?>
              <tr>
                <td><?= $us['username'] ?></td>
                <td><?= $us['nama'] ?></td>
                <td><?= $us['level'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" onclick="editUsers(<?= $us['id_user'] ?>)" data-bs-toggle="modal" data-bs-target="#modalEdit">
                    Edit user
                  </button>
                  <a href="<?= base_url('admin/user/' . $us['id_user']) ?>">
                    <button type="button" class="btn btn-danger text-white">
                      hapus
                    </button>
                  </a>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td colspan="4">
                <h1>Tidak ada User yang terdaftar.</h1>
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
              <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="<?= base_url('admin/user') ?>" method="post">
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="Nama" required placeholder="Enter Nama" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="Username" required placeholder="Enter Username" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="Password" required placeholder="Enter Password" />
                  </div>
                </div>
                <div class="row">
                  <div class="col mb-3">
                    <label class="form-label">Level</label>
                    <select class="form-control" name="level">
                      <option value="Admin">Admin</option>
                      <option value="Kontributor">Kontributor</option>
                    </select>
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
  async function editUsers($id) {
    const form = document.getElementById('editForm');
    form.action = `<?= base_url('admin/user/edit') ?>`+'/' + $id;
    try {
      const response = await fetch(`<?= base_url('json/user') ?>`+'/'+$id);
      const users = await response.json();
      form.Nama.value=users['nama'];
      form.Username.value=users['username'];
      form.level.value=users['level']
    } catch (error) {
      console.erEror('Error fetching users:', error);
    }
  }
</script>
<?= $this->endSection() ?>