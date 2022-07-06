<?php
require_once "function.php";

$data = new Shipping();

$kota = $data->get_city();
$kota_array = json_decode($kota, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chek Postage</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col md-4">
                <div class="card">
                    <div class="card-header">
                        Cek Ongkir
                    </div>
                    <div class="card-body">
                        <form id="form-cek-ongkir">
                            <div class="form-group">
                                <label for="kota_asal">Kota Asal</label>
                                <select name="kota_asal" id="kota_asal" class="form-control">
                                    <option value=""></option>
                                    <?php foreach($kota_array['rajaongkir']['results'] as $key => $value) : ?>
                                        <option value="<?= $value['city_id'] ?>"><?= $value['city_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kota_tujuan">Kota Tujuan</label>
                                <select name="kota_tujuan" id="kota_tujuan" class="form-control">
                                    <option value=""></option>
                                    <?php foreach($kota_array['rajaongkir']['results'] as $key => $value) : ?>
                                        <option value="<?= $value['city_id'] ?>"><?= $value['city_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="berat">Berat Kiriman (gram)</label>
                                <input type="number" id="berat" name="berat" class="form-control" min="1" max="30000">
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary" id="btn-periksa-ongkir">Periksa Ongkir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col md-8">
                <div class="card">
                    <div class="card-header" id="hasil-pengecekan">
                        Hasil Pengecekan
                    </div>
                    <div class="card-body">
                        <table id="table-hasil-pengecekan" class="display">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Kurir</th>
                                    <th>Jenis Layanan</th>
                                    <th>Tarif</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Datatables -->
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- For Option View -->
    <script>
        $('#kota_asal').select2({
            placeholder: 'Pilih Kota Asal',
            theme: "bootstrap"
        });
        $('#kota_tujuan').select2({
            placeholder: 'Pilih Kota Tujuan',
            theme: "bootstrap"
        });
        $('#form-cek-ongkir').on('submit', function(e){
            e.preventDefault();

            let kota_asal = $('#kota_asal').select2('data')[0].text;
            let kota_tujuan = $('#kota_tujuan').select2('data')[0].text;
            let berat = $('#berat').val();
            
            $('#hasil-pengecekan').html(`Hasil Pengecekan <b>${kota_asal}</b> ke <b>${kota_tujuan}</b> @${berat} gram`);
        });

    </script>
</body>
</html>