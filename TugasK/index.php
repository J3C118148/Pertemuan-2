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
  <h2>DATA MAHASISWA</h2>
  <div class="tgh">
  <button type="submit" class="btn btn-primary"><a href="insert.php" style="color:white">Tambah Mahasiswa</a></button>
  </div>
  <br/>
      <?php
                    include "koneksi.php";
                    $r = mysqli_query($kon,"SELECT * FROM mahasiswa");
                    $i = 0;
                    while($brs = mysqli_fetch_assoc($r)){
                      echo "<div class='card mb-3' style='max-width: 540px;'>";
                      echo "<div class='row no-gutters'>";
                      echo "<div class='col-md-4'>";
                      echo "<img width=170 src='Foto/".$brs['foto']."'>";
                      echo "</div>";
                      echo "<div class='col-md-8'>";
                      echo "<div class='card-body'>";
                      echo "<h3 class='card-title'>";
                      echo ++$i.'. '.$brs['nama'].'<br>';
                      echo "</h3>";
                      echo "<h5>";
                      echo $brs['nim'].'<br>';  
                      echo "</h5>";
                      echo "<p class='card-text'>";
                      echo '<br>'.$brs['jenis kelamin'];                            
                      echo "</p>";
                      echo "<p>Agama : ";
                      echo $brs['agama'].'</p>';
                      echo "<p>Hobi : ".$brs['olahraga fav'].'<br></p>';
                      echo " <a class='btn btn-primary' href='edit.php?id=".$brs["id"]."'>Edit</a>";
                      echo " <a class='btn btn-danger' href='delete.php?id=".$brs["id"]."'>Hapus</a>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                      echo "</div>";
                    }
      ?> 
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>