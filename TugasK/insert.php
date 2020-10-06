<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>

    <title>Daftar Data Mahasiswa</title>
    </head>
  <body class="tengah">
  <div class="form">
  <h2>TAMBAH MAHASISWA</h2>
  <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label class="biru">Foto Mahasiswa</label>
    <br/>
    <input type="file"  name="foto"/>
  </div>
  <div class="form-group">
    <label >NIM</label>
    <input type="text" class="form-control" name="nim">
  </div>
  <div class="form-group">
    <label >Nama</label>
    <input type="text" class="form-control" name="nama">
  </div>
  <div class="form-group">
    <label >Jenis Kelamin</label>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="jenisk" value="laki-laki">
  <label class="form-check-label">Laki-Laki</label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="jenisk" value="perempuan">
  <label class="form-check-label">Perempuan</label>
</div>
  </div>
  <div class="form-group">
  <label>Agama</label>
    <select class="form-control" name="agama" value="agama">
      <option name="agama" selected disabled value="">Pilih</option>
      <option name="agama" value="islam">Islam</option>
      <option name="agama" value="kristen">Kristen</option>
      <option name="agama" value="hindu">Hindu</option>
      <option name="agama" value="budha">Budha</option>
      <option name="agama" value="konghucu">Konghucu</option>
    </select>

  </div>
  <div class="form-group">
    <label >Olahraga Favorit</label>
    <br/>
    <label><input type="checkbox" name="hobi[]" value="SepakBola"> Sepak Bola</label><br>
            <label><input type="checkbox" name="hobi[]" value="Basket"> Basket</label><br>
            <label><input type="checkbox" name="hobi[]" value="Futsal"> Futsal</label><br>
            <label><input type="checkbox" name="hobi[]" value="Renang"> Renang</label><br>
            <label><input type="checkbox" name="hobi[]" value="Badminton"> Badminton</label><br>
  </div>
  <div class="form-group tgh">
    <input type="submit" class="btn btn-success" name="sub" value="Simpan">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" class="btn btn-outline-secondary" name="sub" value="Kembali">
  </div>
  </div>

  <?php
  $ms="";
    if (isset($_POST["sub"])) {
        if($_POST['sub']=='Kembali'){
            header("location:index.php");
        }
        else {
            if (strlen($_POST['nama'])) {
                include "koneksi.php";

                $ekstensi_diperbolehkan = array('png', 'jpg');
                $file_nama = $_FILES['foto']['name'];
                $x = explode('.', $file_nama);
                $ekstensi = strtolower(end($x));
                $ukuran = $_FILES['foto']['size'];
                $file_tmp = $_FILES['foto']['tmp_name'];


                $hobi= implode(", ", $_POST['hobi']);
                $cek = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE nim='$nim'");
                
                if (mysqli_num_rows($cek) == 0) {
                  if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                      move_uploaded_file($file_tmp, 'Foto/' . $file_nama);
                      $sam = mysqli_query($kon,"INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jenis kelamin`, `agama`, `olahraga fav`, `foto`)
                                   VALUES (NULL, '".$_POST['nim']."','".$_POST['nama']."','".$_POST['jenisk']."','".$_POST['agama']."','".$hobi."','".$file_nama."')");
                      if ($sam) {
                        echo '<script>alert("Berhasil menambahkan data."); document.location="index.php";</script>';
                      } else {
                        echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
                      }

                    } else {
                      echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                  } else {
                    echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
                  }

                } else {
                  echo '<div class="alert alert-warning">Gagal, NIM sudah terdaftar.</div>';
                }

            }
        }
    }

    
  ?>
  
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>