<?= $this->extend('layouts/admin')?>
<?= $this->section('title')?>
    Pengaduan
<?= $this->endSection()?>
<?= $this->section('content')?>

<div class="col">
    <div class="card">
        <div class="card-header bg-primary">
          <?php
          if(session()->get('level')=='masyarakat'){
            ?>
            <a href="#" data-pengaduan="" class="btn btn-light" data-target="#modalPengaduan" data-toggle="modal"><i class="fas fa-fw fa-solid fa-user-plus"></i>Tambah Data</a>
            <?php } ?>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No</th>
                    <th>Tgl Pengaduan</th>
                    <th>Nik</th>
                    <th>Isi Laporan</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
                <?php 
                $no = 0;
                foreach ($pengaduan as $row){
                    $no++;
                    $data=$row['tgl_pengaduan'].",".$row['nik'].",".$row['isi_laporan'].",".$row['foto'].",".$row['status'].",".base_url('pengaduan/edit/'.$row['id_pengaduan']);
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['tgl_pengaduan'] ?></td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['isi_laporan'] ?></td>
                        <td><?= $row['foto'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            
                <?php
                if(session('level')=='masyarakat'){
                    if($row['status']=='0'){
                        ?>
                    <a  onclick="return_confirm('yakin hapus data');" class="btn btn-danger" href="/pengaduan/hapus/<?$row['id_pengaduan']?>"><i class="fa fa-trash"></i class="fa fa-trash"></i></a>
                    <?php
                    }else{
                    }
                  }
                  if(!empty(session('level'))&& session('level')!='masyarakat'){
                    if($row['status']=='0'){
                        ?>
                        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalTanggapan" data-pengaduan="<?=$row['id_pengaduan']?>">Tanggapi</a>
                        <?php
                    }else{
                        
                    }
                  }
                }
                ?>
            </table>
        </div>
    </div>
  </div>
<div class="modal fade" id="modalPengaduan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Pengaduan</h5>
            </div>
            <form action="/tambahpengaduan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Isi Laporan</label>
                        <textarea class="form-control" name="isi_laporan" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </div>
              </form>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="modalTanggapan" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"></div>
            <form action="/tanggapi" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Tanggapan</label>
                        <textarea name="tanggapan" id="" clos="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection()?>
<?= $this->Section("script")?>
<?= $this->endSection()?>

    