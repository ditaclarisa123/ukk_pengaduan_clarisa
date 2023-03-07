<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>
Tanggapan
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Heading -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <a href="#" data-tanggapan="" class="btn btn-light" data-target="#modaltanggapan" data-toggle="modal"><i class="fas fa-fw fa-solid fa-user-plus"></i>Tanggapan baru</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Pengaduan</th>
                            <th>Tgl_Tanggapan</th>
                            <th>Tanggapan</th>
                            <th>Id_Petugas</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                        $no = 0;
                        foreach ($tanggapan as $row) {
                            $no++;
                            $data = $row['id_pengaduan'] . "," . $row['tgl_tanggapan'] . "," . $row['tanggapan'] . "," . $row['id_petugas'] . "," . base_url('tanggapan/edit/' . $row['id_tanggapan']);
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['id_pengaduan'] ?></td>
                                <td><?= $row['tgl_tanggapan'] ?></td>
                                <td><?= $row['tanggapan'] ?></td>
                                <td><?= $row['id_petugas'] ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modaltanggapan" data-tanggapan="<?= $data ?>"><i class="fas fa-edit"></i>Edit</a>
                                    <a href="<?= base_url('tanggapan/delete/' . $row['id_tanggapan']) ?>" onclick="return confirm('yakin mau hapus')" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltanggapan" tabindex="1" aria-labelledby="modaltanggapanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input data Tanggapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmtanggapan" action="" method="post">
                    <div class="modal-body">
                        <div class="modal-group">
                            <label for="id_pengaduan">id_pengaduan</label>
                            <input type="text" name="id_pengaduan" class="form-control" id="id_pengaduan">
                        </div>
                        <div class="form-group">
                            <label for="tgl_tanggapan">tgl_tanggapan</label>
                            <input type="date" name="tgl_tanggapan" class="form-control" id="tgl_tanggapan">
                        </div>
                        <div class="form-group">
                            <label for="tanggapan">tanggapan</label>
                            <input type="text" name="tanggapan" class="form-control" id="tanggapan">
                        </div>
                        <div class="form-group">
                            <label for="id_petugas">id_petugas</label>
                            <input type="text" name="id_petugas" class="form-control" id="id_petugas">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->Section("script") ?>
<script>
    $(document).ready(function() {
        $("#modaltanggapan").on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var data = button.data('tanggapan');
            if (data != "") {
                const barisdata = data.split(",");
                $('#id_pengaduan').val(barisdata[0]);
                $('#tgl_tanggapan').val(barisdata[1]);
                $('#tanggapan').val(barisdata[2]);
                $('#id_petugas').val(barisdata[3]).change();
                $('#frmtanggapan').attr('action', barisdata[4]);
            } else {
                $('#id_pengaduan').val('');
                $('#tgl_tanggapan').val('');
                $('#tanggapan').val('');
                $('#id_petugas').val('').change();
                $('#frmtanggapan').attr('action','/stanggapan');
            }
        });
    })
</script>
<?= $this->endSection() ?>