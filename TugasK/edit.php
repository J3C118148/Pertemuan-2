<?php include('koneksi.php'); 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id='$id'");

        if (mysqli_num_rows($select) == 0) {
            echo '<div class="alert-warning">ID tidak ada dalam database.<div>';
            exit();
        } else{
            $data = mysqli_fetch_assoc($select);
        }
        $dataolah=explode(', ', $data['olahraga fav']);
    }
?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

   <link rel="stylesheet" href="css/style.css">
    <title>Edit Mahasiswa</title>
</head>
<body class="tengah">
<div class="form">
<div class="heading">
    <div class="header-title">
        <h2>Edit Mahasiswa</h2>
    </div>
</div>

    <div class="content-form">
        
        <?php

        
        if (isset($_POST['submit'])){
            include "koneksi.php";
            $nim = $_POST['nim'];
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenisk'];
            $agama  = $_POST['agama'];
            $hobi = implode(", ", $_POST['hobi']);
            $ekstensi_diperbolehkan = array('png', 'jpg');
            $file_nama = $_FILES['foto']['name'];
            $x = explode('.', $file_nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            
            if ($nim != "") {
                if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'Foto/' . $file_nama);
                        $sql = mysqli_query($kon, "UPDATE `mahasiswa` SET `nim`='".$nim."', `nama`='".$nama."', `jenis kelamin`='".$jenis_kelamin."', `agama`='".$agama."', `olahraga fav`='".$hobi."', `foto`='".$file_nama."'
                        WHERE `mahasiswa`.`id` = ".$_POST['idupdate']);
                        if ($sql) {
                            echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                        }
                    }
                    else {
                        echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                
            }else {
                echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
            }
                
            
        }else{
            $sql = mysqli_query($kon, "UPDATE `mahasiswa` SET `nim`='".$nim."', `nama`='".$nama."', `jenis kelamin`='".$jenis_kelamin."', `agama`='".$agama."', `olahraga fav`='".$hobi."'
                        WHERE `mahasiswa`.`id` = ".$_POST['idupdate']);
            if ($sql) {
                echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
            } else {
                echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
            }
        }
    }
        ?>


        <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-form-label">NIM</label>
                <div >
                    <input type="text" name="nim" class="form-control" size="9" value="<?php echo $data['nim']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Nama</label>
                <div>
                    <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Jenis Kelamin</label>
                <div >
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenisk" value="laki-laki"  <?php if ($data['jenis kelamin'] == 'laki-laki') {
																												echo 'checked';
																											} ?> required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="jenisk" value="perempuan"  <?php if ($data['jenis kelamin'] == 'perempuan') {
																												echo 'checked';
																											} ?> required>
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Agama</label>
                <div>
                <?php $agama = $data["agama"];?>
                <select class="form-control" id="agama" name="agama">
                <option value="islam" <?php echo ($agama == 'islam') ? "selected": ""?>>Islam</option>
                <option value="kristen" <?php echo ($agama == 'kristen') ? "selected": ""?>>Kristen</option>
                <option value="hindu" <?php echo ($agama == 'hindu') ? "selected": ""?>>Hindu</option>
                <option value="buddha" <?php echo ($agama == 'buddha') ? "selected": ""?>>Buddha</option>
                <option value="konghucu" <?php echo ($agama == 'konghucu') ? "selected": ""?>>Konghucu</option>
            </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-form-label">Olahraga</label>
                <div>
                <?php $olahraga = $data["olahraga fav"];?>
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="SepakBola"
                        <?php if (in_array("SepakBola", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Sepak Bola
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Basket"
                        <?php if (in_array("Basket", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Basket
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Futsal"
                        <?php if (in_array("Futsal", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Futsal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Renang"
                        <?php if (in_array("Renang", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Renang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="Badminton"
                        <?php if (in_array("Badminton", $dataolah)) echo "checked";?>>
                        <label class="form-check-label">
                            Badminton
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Foto</label>
                <div>
                <input type="file" name="foto" value="ft">
            </div>
            </div>

                <div class="tgh" style="margin-left:265px;margin-right:265px;">
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="Simpan">
                    <input type="hidden" name="idupdate" value="<?php 
                                                        if (isset($_GET['idupdate']))
                                                            echo $_GET['idupdate']; 
                                                        else
                                                            echo $_GET['id'];
                                                        ?>">
                </div>
                <br/>
                <div class="tgh">
                <div class="btn btn-outline-secondary">
                    <a href="index.php" class="tombol tambah">Kembali</a>
                </div>
                                                                                                        </div>
        </form>
    </div>
</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
