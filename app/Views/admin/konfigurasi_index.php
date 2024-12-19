<?= $this->extend('Template_admin') ?>

<?= $this->section('judul_halaman') ?> hmmm
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Vertically Centered Modal -->
<div class="container">
  <div class="mt-3">
    <!-- Modal -->
    <form id="editForm" action="<?= base_url('admin/konfigurasi') ?>" method="post">
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Judul Website</label>
          <input type="text" name="judul_website" value="<?= $konfigurasi['judul_website'] ?>" class="form-control"
            required placeholder="Judul Website">
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Profil Website</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['profil_website'] ?>" name="profil_wesbite"
            required placeholder="Profil Website" />
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Instagram</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['instagram'] ?>" name="instagram" required
            placeholder="Instagram" />
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">facebook</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['facebook'] ?>" name="facebook" required
            placeholder="facebook" />
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Email</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['email'] ?>" name="email" required
            placeholder="Email" />
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Alamat</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['alamat'] ?>" name="alamat" required
            placeholder="Alamat" />
        </div>
      </div>
      <div class="row">
        <div class="col mb-3">
          <label class="form-label">Nomor Wa</label>
          <input type="text" class="form-control" value="<?= $konfigurasi['no_wa'] ?>" name="no_wa" required
            placeholder="Nomor Wa" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
</div>
<?= $this->endSection() ?>