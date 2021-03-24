<?php  
$kategori = $_POST['urutan'];
$query = "SELECT * FROM produk ORDER BY stok $kategori";
?>


<?php
  include('koneksi.php');
?>
<!DOCTYPE html>
<html>
  <head>
  <title>CRUD Produk dengan gambar - Gilacoding</title>
    <style type="text/css">
      * {
        font-family: "helvetica";
      }
      h1 {
        text-transform: uppercase;
        color: #6484b5;
      }
    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 95%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: center;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        color: #333;
        padding: 10px;
        text-align: center
    }
    a.action {
          background-color: gray;
          color: #fff;
          padding: 10px 20px;
          text-decoration: none;
          font-size: 12px;
          border-radius: 7px;
    }

    tr:nth-child(even) {
      background: #e8eaed;
    }

    .container{
      border: 1px solid #6c757d;
      width: 1000px;
      margin: auto;
      border-radius: 20px;
      padding: 10px;
    }

    a.tambah-produk{
      display: inline-block;
      margin-top: 10px;
      margin-left: -10px;
      width: 200px;
      font-size:17px;
      background: #6c757d;
      color: #fff;
      text-decoration: none;
      padding: 10px;
      border-radius: 4px;
    }
    .tambah{
      margin-right: 8px;
    }
    
    .kategori{
      display: inline-block;
      font-size: 20px;
      font-family: "segoe ui";
      font-weight: 500;
      margin-left: 112px;
    }

    .kategori-button{
      display: inline-block;  
    }

    .tombol{
      border: none;
      padding: 7px 12px;
      border-radius: 8px;
      background: #474646;
      color: white;
    }

    .tombol-pojok{
      margin-right: 112px;
    }
    
    .search{
      display: inline-block;
    }

    .cari{
      height: 25px;
      width: 160px;
      font-size: 15px;
    }

    .cari-tombol{
      height: 26px;
      background-color: #6c757d;
      color: white;
      border-radius: 5px;
      border: none;
      padding: 5px 9px;
    }

    .left{
      text-align: left;
    }

    </style>
  </head>
  <body>
  <center><h1>Data Produk</h1><center>
    <div class="container">
        <a href="tambah_produk.php" class="tambah-produk"><span class="tambah">+</span> Tambah Produk</a>
        <P class="kategori">Urutkan:</P>
        <form action="urutkan.php" method="POST" class="kategori-button">
          <button class="tombol" value="ASC" name="urutan">Terdikit</button>
          <button class="tombol tombol-pojok" value="DESC" name="urutan">Terbanyak</button>
        </form>
        <form action="cari.php" method="GET" class="search">
          <input type="text" placeholder="Ketik nama produk" class="cari" name="keyword">
          <input type="submit" value="Cari!" class="cari-tombol">
        </form>
        <form action="index.php" class="search">
        <input type="submit" value="X" class="cari-tombol">
        </form>
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Dekripsi</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Gambar</th>
              <th>Action</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $result = mysqli_query($koneksi, $query);
          
          if(!$result){
            die ("Query Error: ".mysqli_errno($koneksi).
              " - ".mysqli_error($koneksi));
          }

          
          $no = 1;
          
          
          while($row = mysqli_fetch_assoc($result))
          {
          ?>
          <tr>
              <td><center><?php echo $no; ?></center></td>
              <td class="left"><?php echo $row['nama_produk']; ?></td>
              <td class="left"><?php echo substr($row['deskripsi'], 0, 20); ?></td>
              <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
              <td><?php echo $row['stok']; ?></td>
            
              <td style="text-align: center;"><img src="gambar/<?php if($row['gambar_produk'] == ""){ echo "default.jpg";}else {echo $row['gambar_produk'];}?>" style="width: 80px;"></td>

              <td>
                  <a href="edit_produk.php?id=<?php echo $row['id']; ?>" class="action">Edit</a>
                  <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" class="action" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
              </td>
          </tr>
            
          <?php
            $no++;
          }
          ?>
        </tbody>
        </table>
    </div>
  </body>
</html>
    