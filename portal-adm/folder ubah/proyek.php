<?php

if(isset($method)): date_default_timezone_set('Asia/Jakarta');
        $aksi = URL."controller/proyek_control/proyek_control.php?model=proyek&method="; // halaman untuk eksekusi
    switch($method) {
            default:
            echo '

                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="widget">
                                <div class="whead warning">
                                    <h6>Data Donator Terbaru (Belum Terverifikasi)</h6>
                                </div>
                                <div class="wbody">
                                <table cellpadding="0" cellspacing="0" border="0" class="display dtable" id="example1" width="100%" data-table-ajax="">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. Handphone</th>
                                    <th>Email</th>
                                    <th>Jumlah</th>
                                    <th>Bank</th>
                                    <th>Bukti</th>
                                    <th>Tindakan</th>
                                </tr>
                                </thead>
                                <tbody>
                ';
                                $no = 1;
                                $data = $proyek3->tarikDataNonKonfirm($method);
                                // $data = $home->tarikDataNonAktif();
                                foreach($data as $data){

            echo '                          
                                <tr >
                                    <td>'.$no.'</td>
                                    <td>'.$data['nama'].'</td>
                                    <td>'.$data['nop'].'</td>
                                    <td>'.$data['email'].'</td>
                                    <td>Rp. '.$data['jumlah'].'</td>
                                    <td>'.$data['bank'].'</td>
                ';                  if ($data['bukti']==NULL) {
            echo '                            <td><a target="_blank" href="'.ROOT.'donasi/assets/'.'img/'.'default.jpg" data-lightbox="image-1" data-title="Bukti Transfer : Tidak Ada Bukti yang Disertakan" >Lihat bukti transfer</a></td>
                 ';                   } 
                                  else{
            echo '                       <td><a target="_blank" href="'.ROOT.'donasi/assets/'.'img/'.'bukti/'.$data['bukti'].'" data-lightbox="image-1" data-title="Bukti Transfer : '.$data['bukti'].'" >Lihat bukti transfer</a></td>
                ';                   }

            echo '                   <td>  
                                       <a href="'.$aksi.'konfirm&id='.$data['id'].'&m='.$data['email'].'" class="btn btn-success btn-sm" role="button">Konfirmasi</a>
                                        <a href="'.URL.'proyek/ubah/'.$data['id'].'" class="btn btn-warning btn-sm" role="button"><i class="glyphicon glyphicon-edit"></i>&nbsp; Ubah</a>
                                       <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#HapusData'.$no.'" role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                                <!-- Modal  -->
                                                            <div class="modal fade" id="HapusData'.$no.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Hapus Data Donasi</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Anda Yakin Ingin Menghapus Data Donasi Ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                             <a href="'.$aksi.'hapus&id='.$data['id'].'" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                     </td>
                                </tr>
                ';              $no++;}
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
                                    <div class="whead success">
                                        <h6>Data Proyek Yayasan Ayo Bantu Masjid</h6>
                                    </div>
                                    <div class="wbody">
                                        <table cellpadding="0" cellspacing="0" border="0" class="display dtable" id="example1" width="100%"" data-table-ajax="">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>No. Handphone</th>
                                                    <th>Email</th>
                                                    <th>Jumlah</th>
                                                    <th>Bank</th>
                                                    <th>Bukti</th>
                                                    <th>Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                ';
                                                 $no = 1;
                                $data = $proyek->tarikDataKonfirm($method);
                                foreach($data as $data){   
            echo '                                  
                                <tr >
                                    <td>'.$no.'</td>
                                    <td>'.$data['nama'].'</td>
                                    <td>'.$data['nop'].'</td>
                                    <td>'.$data['email'].'</td>
                                    <td>Rp. '.$data['jumlah'].'</td>
                                    <td>'.$data['bank'].'</td>
            ';                  if ($data['bukti']==NULL) {
            echo '                            <td><a target="_blank" href="'.ROOT.'donasi/assets/'.'img/'.'default.jpg" data-lightbox="image-1" data-title="Bukti Transfer : Tidak Ada Bukti" >Lihat bukti transfer</a></td>
                 ';                   } 
                                  else{
            echo '                       <td><a target="_blank" href="'.ROOT.'donasi/assets/'.'img/'.'bukti/'.$data['bukti'].'" data-lightbox="image-1" data-title="Bukti Transfer : '.$data['bukti'].'" >Lihat bukti transfer</a></td>
                ';                   }                        
            echo '

                                    <td>
                                    <a href="'.URL.'proyek/ubah/'.$data['id'].'" class="btn btn-warning btn-sm" role="button"><i class="glyphicon glyphicon-edit"></i>&nbsp; Ubah</a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#HapusDataKonfirm'.$no.'" role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                                <!-- Modal  -->
                                                            <div class="modal fade" id="HapusDataKonfirm'.$no.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Hapus Data Donasi</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Anda Yakin Ingin Menghapus Data Donasi Ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                             <a href="'.$aksi.'hapus&id='.$data['id'].'" class="btn btn-danger " role="button"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                    </td>
                                </tr>
                ';              $no++;}
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
                        <a href="'.URL.'" class="pull-right" style="padding: 20px 20px;">&#8678; Kembali Ke Halaman Proyek</a>
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
                                        <button type="button" class="btn btn-danger">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="ara"></div>
                </div>
                    ';
            break;
            case "ubah":
            if(filter_var($parameter, FILTER_VALIDATE_INT)){
                $data = $proyek->tarikDataById($parameter);
 
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
                              <input type="text" name="nama" class="form-control" value="'.$data['nama'].'" placeholder="Nama Anda...">
                              <input type="hidden" class="form-control" name="id" value="'.$parameter.'" >
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">No. Telp</label>
                            <div class="col-sm-8">
                              <input type="text" name="nop" class="form-control" value="'.$data['nop'].'" placeholder="Nomor Telp...">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-8">
                              <input type="text" name="email" class="form-control" value="'.$data['email'].'" placeholder="Email Anda...">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Donasi</label>
                            <div class="col-sm-8">
                              <input type="text" name="jumlah" class="form-control" value="'.$data['jumlah'].'" placeholder="Jumlah Donasi...">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                              <a onclick="goBack()" class="btn btn-danger" role="button" >Batal</a>
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
                 echo"<script> window.history.back(); </script>";
                // echo"<script> alert('Menambah data'); </script>";
                return false;
            }
    }
?>
<?php endif; ?>