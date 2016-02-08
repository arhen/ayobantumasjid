<?php
    if(isset($method)): 
        // date_default_timezone_set('Asia/Jakarta');
        $aksi = URL."controller/home_control/home_control.php?model=home&method="; // halaman untuk eksekusi

    echo '
        <div class="content">
        <div class="row">
    ';

    switch($method) {
            default:
                echo '
                            <div class="col-md-12 row-button">
                            <a href="'.URL.'home/tambah/" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-plus"></span> Tambah Proyek</a>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="widget">
                                    <div class="whead warning">
                                        <h6>Data Proyek Sedang Berjalan (On Progress)</h6>
                                    </div>
                                    <div class="wbody">
                                        <table cellpadding="0" cellspacing="0" border="0" class="display dtable" id="example1" width="100%" data-table-ajax="">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Proyek</th>
                                                    <th>Target Dana</th>
                                                    <th>Dana terkumpul (progress)</th>
                                                    <th>Waktu Sisa</th>
                                                    <th>Butuh Konfirmasi</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                                                $no = 1;
                                                $total = 0;
                                                $data = $home->tarikDataNonAktif();
                                                foreach($data as $data){
                                                    if ($total == 0) {
                                                        $proyek3 = $proyek->tarikDataByIdProyek($data['id_proyek']);
                                                        foreach ($proyek3 as $proyek3) {
                                                            $home->ubahData($data['id_proyek'],$proyek3);
                                                            $total++;
                                                        }
                                                        $total= 0;
                                                    }

                echo '                          
                                                <tr >
                                                    <td>'.$no.'</td>
                                                    <td>'.$data['nama_proyek'].'</td>
                                                    <td>Rp. '.$data['target_dana'].'</td>
                    ';                              if ($data['total']==NULL) {
                echo '                                  <td>Rp. 0</td>
                     ';                             } 
                                                    else{
                echo '                                   <td>Rp. '.$data['total'].'</td>
                    ';                              }
                                                    $date1 = new DateTime(date('d-m-Y'));
                                                    $date2 = new DateTime($data['tanggal_selesai']);
                                                    if ($date1>$date2) {
                   echo '
                                                    <td>0 Hari!!</td>
                    ';
                                                    }else {
                                                    $interval = $date1->diff($date2);
                                                    // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

                                                    // shows the total amount of days (not divided into years, months and days like above)
                                                    // echo "difference " . $interval->days . " days ";
                echo '
                                                    <td>'.$interval->days.' Hari</td>
                    ';
                                                    }
                                                   $konfirm=0;
                                                   $proyek4 = $proyek->tarikDataNonKonfirm($data['id_proyek']);
                                                   foreach ($proyek4 as $proyek4) {
                                                       $konfirm++;
                                                   }
                echo '                              <td><a href="'.URL.'proyek/'.$data['id_proyek'].'/proyek/'.'">'.$konfirm.' Donasi Baru</a></td>    

                <td>';
                                                   $prior = $home->tarikPrioritas();
                                                    foreach ($prior as $prior) {
                                                        if ($data['id_proyek']==$prior['id_proyek'] AND $prior['prior']==1) {
                                                            echo '
                                                                <a href="'.$aksi.'terapkan&id_proyek='.$data['id_proyek'].'" class="btn btn-primary btn-sm disabled" role="button"><span class="glyphicon glyphicon-download"></span> Diterapkan</a>
                                                            ';
                                                        }else{
                                                            echo '
                                                                <a href="'.$aksi.'terapkan&id_proyek='.$data['id_proyek'].'" class="btn btn-primary btn-sm" role="button" ><span class="glyphicon glyphicon-download"></span> Terapkan ke Form</a>
                                                            ';
                                                        }

                                                    

                echo '                                                     
                                                       <div class="btn-group" style="display:inline-block;"">
                                                            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                Pilih <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="'.URL.'proyek/'.$data['id_proyek'].'/proyek/'.'"><i class="glyphicon glyphicon-search"></i>&nbsp; Lihat</a></li>
                                                                <li><a href="'.URL.'home/ubah/'.$data['id_proyek'].'"><i class="glyphicon glyphicon-edit"></i>&nbsp; Ubah</a></li>
                                                                <li><a href="'.$aksi.'selesai&id_proyek='.$data['id_proyek'].'"><i class="glyphicon glyphicon-check"></i>&nbsp; Selesai</a></li>
                                                                <li class="divider"></li>
                    ';                                          if ($prior['prior']==1) {
                echo '                                             <li><a href="'.$aksi.'batalprior&id_proyek='.$data['id_proyek'].'" role="button"><i class="glyphicon glyphicon-upload"></i>&nbsp; Batal Terapkan</a></li>
                     ';                                          }
                                                    }
                echo '          

                                                                <li><a href="#" role="button" data-toggle="modal" data-target="#HapusProyek"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</a></li>
                                                            </ul>
                                                       </div>
                                                         <!-- Modal  -->
                                                            <div class="modal fade" id="HapusProyek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Hapus Proyek</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Anda Yakin Ingin Menghapus Proyek Ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                             <a href="'.$aksi.'hapus&id_proyek='.$data['id_proyek'].'" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    </td>
                                                 </tr>
                ';
                                                 $no++;
                                                 }
                echo '
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="widget">
                                    <div class="whead primary">
                                        <h6>Data Proyek Yayasan Ayo Bantu Masjid</h6>
                                    </div>
                                    <div class="wbody">
                                        <table cellpadding="0" cellspacing="0" border="0" class="display dtable" id="example1" width="100%"" data-table-ajax="">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Proyek</th>
                                                    <th>Target Dana</th>
                                                    <th>Dana terkumpul</th>
                                                    <th>Waktu Sisa</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                                                $no = 1;
                                                $total=0;
                                                $data2 = $home->tarikDataAktif();
                                                    foreach($data2 as $data2){
                                                        if ($total==0) {
                                                            $proyek2 = $proyek2->tarikDataByIdProyek($data2['id_proyek']);
                                                            foreach ($proyek2 as $proyek2) {
                                                             // $total = $total + $proyek2['jumlah'];
                                                                $home->ubahData($data2['id_proyek'],$proyek2);
                                                                  $total++;
                                                            }

                                                        }
                echo '
                                                <tr >
                                                    <td>'.$no.'</td>
                                                     <td>'.$data2['nama_proyek'].'</td>
                                                     <td>Rp. '.$data2['target_dana'].'</td>
                ';                                  if ($data2['total']==NULL) {
                echo '                                  <td>Rp. 0</td>
                     ';                             } 
                                                    else{
                echo '                                   <td>Rp. '.$data2['total'].'</td>
                    ';                              }
                                                   $date1 = new DateTime(date('d-m-Y'));
                                                    $date2 = new DateTime($data2['tanggal_selesai']);
                                                    if ($date1>$date2) {
                   echo '
                                                    <td>0 Hari</td>
                    ';
                                                    }else {
                                                    $interval = $date1->diff($date2);
                                                    // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 

                                                    // shows the total amount of days (not divided into years, months and days like above)
                                                    // echo "difference " . $interval->days . " days ";
                echo '
                                                    <td>'.$interval->days.' Hari</td>
                    ';
                                                    }
                                                    
                echo '                             <td>';
                echo '
                                                     <a href="'.$aksi.'nselesai&id_proyek='.$data2['id_proyek'].'" class="btn btn-warning btn-sm" role="button"><span class="glyphicon glyphicon-check"></span> Jalankan Lagi</a>
                                                     <a href="'.$aksi.'broadcast&id_proyek='.$data2['id_proyek'].'" class="btn btn-warning btn-sm" role="button"><span class="glyphicon glyphicon-check"></span> Broadcast Pesan</a>
                
                                                     <a
                                                        href="'.URL.'proyek/'.$data2['id_proyek'].'/proyek/'.'" class="btn btn-success btn-sm" role="button"><span class="glyphicon glyphicon-search"></span> Lihat</a>   
                                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#HapusProyek" role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                                <!-- Modal  -->
                                                            <div class="modal fade" id="HapusProyek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Hapus Proyek</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Anda Yakin Ingin Menghapus Proyek Ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                             <a href="'.$aksi.'hapus&id_proyek='.$data2['id_proyek'].'" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </tr>
                                                   ';
                                                   $no++;}
                echo '
                                            </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                       <th></th>
                                                       <th></th>
                                                       <th></th>
                                                    </tr>
                                                </tfoot>
                                        </table>
                                    </div>
                                    <div class="clearfix">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>

                    ';
            break;
            case "tambah":
               echo '
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h4 align="center">Tambah Data Proyek Terbaru</h4>
                  </div>
                  <div class="panel-body">
                    <form id="formTambahProyek" class="form-horizontal" role="form" enctype="multipart/form-data" action="'.$aksi.'tambah" method="POST">
                      <div class="col-xs-12 col-sm-12">
                          <div class="form-group">
                            <div class="alert alert-warning col-sm-8 col-sm-offset-2">Perhatian! Mohon Isi Nama Proyek Dengan Nama yang Sesuai.</div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Proyek</label>
                            <div class="col-sm-8">
                              <input type="text" name="nama_proyek" class="form-control" placeholder="Nama Proyek...">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi Proyek</label>
                            <div class="col-sm-8">
                                <textarea name="desc_proyek" class="form-control">
                                </textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Target Dana</label>
                            <div class="col-sm-5">
                              <input type="text" name="target_dana" class="form-control" placeholder="Target Dana">
                              <span id="helpBlock" class="help-block"><i>Cukup menuliskan angka (ex:20000000)</i></span>
                            </div>
                          </div>
                          <div class="form-group">
                             <label class="col-sm-2 control-label" >Tanggal Selesai</label>
                            <div class="col-sm-4">
                                <input type="text"  id="dp2" name="selesai" value="'.date('d-m-Y').'">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Gambar :</label>
                            <div class="col-sm-4">
                                <label class="">*.png | *.jpg dibawah 1 MB (jika ada)</label>
                                <div id="imagePreview" class="col-sm-4"></div>
                                <br>
                                <br>
                                <input type="file" name="file" id="uploadFile" accept="image/*" >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                              <a href="'.URL.'" class="btn btn-danger" role="button" >Batal</a>
                              <button type="submit" name="simpan" class="btn btn-default">Tambah</button>
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
               ';
            break;
            case "ubah":
            if(filter_var($parameter, FILTER_VALIDATE_INT)){
                $data = $home->tarikDataByIdProyek($parameter);
 
               echo '
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h4 align="center">Ubah Data Proyek</h4>
                  </div>
                  <div class="panel-body">
                    <form id="formTambahProyek" class="form-horizontal" role="form" enctype="multipart/form-data" action="'.$aksi.'ubah" method="POST">
                      <div class="col-xs-12 col-sm-12">
                          <div class="form-group">
                            <div class="alert alert-warning col-sm-8 col-sm-offset-2">Perhatian! Mohon Ubah Data Proyek Dengan Hati-hati!.</div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Proyek</label>
                            <div class="col-sm-8">
                              <input type="text" name="nama_proyek" class="form-control" value="'.$data['nama_proyek'].'" placeholder="Nama Proyek...">
                              <input type="hidden" class="form-control" name="id_proyek" value="'.$parameter.'" >
                              <input type="hidden" class="form-control" name="gambar"   value="'.$data['gambar'].'" >
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Deskripsi Proyek</label>
                            <div class="col-sm-8">
                                <textarea name="desc_proyek" class="form-control">
                                '.$data['desc_proyek'].'
                                </textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Target Dana</label>
                            <div class="col-sm-5">
                              <input type="text" name="target_dana" class="form-control" value="'.$data['target_dana'].'" placeholder="Target Dana" required>
                              <span id="helpBlock" class="help-block"><i>Cukup menuliskan angka (ex:20000000)</i></span>
                            </div>
                          </div>
                          <div class="form-group">
                             <label class="col-sm-2 control-label" >Tanggal Selesai</label>
                            <div class="col-sm-4">
                                <input type="text"  id="dp2" value="'.date('d-m-Y',strtotime($data['tanggal_selesai'])).'" name="selesai" value="'.date("d/m/Y").'">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Gambar :</label>
                            <div class="col-sm-4">
                                <label >*.png | *.jpg dibawah 1 MB (<b color="red">Jika tidak ada perubahan gambar harap dikosongkan </b>)</label>
                                <div id="imagePreview" class="col-sm-4"></div>
                                <img style="max-width:520px; max-height:500px; float:left;" src="'.ROOT.'assets/images/proyek/'.$data['gambar'].'" />
                                <br>
                                <br>
                                <input type="file" value="asdasd" name="file" id="uploadFile" accept="image/*" >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                              <a href="'.URL.'" class="btn btn-danger" role="button" >Batal</a>
                              <button type="submit" name="simpan" class="btn btn-default">Simpan Perubahan</button>
                            </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
               ';
            break;
            }else{
                header("location:".URL."home");
                return false;
            }

    }
    echo '
             </div>
             <div class="ara"></div>
        </div>        

    ';
?>
<?php endif; ?>
