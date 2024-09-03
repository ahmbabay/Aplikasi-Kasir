<?php
//import koneksi ke database
require 'ceklogin.php';

//hitung jumlah pesanan
$h1 = mysqli_query($c, "select * from pesanan");
$h2 = mysqli_num_rows($h1); // jumlah pesanan



?>
<html>

<head>
    <title>Stock Barang</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
    <div class="container">
        <h2>Stock Bahan</h2>
        <h4>(Inventory)</h4>
        <div class="data-tables datatable-dark">

            <!-- Masukkan table nya disini, dimulai dari tag TABLE -->
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get = mysqli_query($c, "SELECT `pesanan`.`idorder`, `pesanan`.`tanggal`, `pelanggan`.`namapelanggan`, `pelanggan`.`alamat`, SUM(`produk`.`harga` * `detailpesanan`.`qty`) AS total FROM produk, detailpesanan, pesanan, pelanggan WHERE detailpesanan.idproduk = produk.idproduk AND pesanan.idpelanggan = pelanggan.idpelanggan AND detailpesanan.idpesanan = pesanan.idorder GROUP BY pesanan.idorder");

                    while ($p = mysqli_fetch_array($get)) {
                        $idorder = $p['idorder'];
                        $tanggal = $p['tanggal'];
                        $namapelanggan = $p['namapelanggan'];
                        $alamat = $p['alamat'];
                        $total = $p['total'];

                        //hitung jumlah
                        $hitungjumlah = mysqli_query($c, "select * from detailpesanan where idpesanan='$idorder'");
                        $jumlah = mysqli_num_rows($hitungjumlah);

                    ?>


                        <tr>
                            <td><?php echo $idorder; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $namapelanggan; ?> - <?php echo $alamat; ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td><?php echo $total; ?></td>
                        </tr>



                    <?php
                    }; //end of while
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>