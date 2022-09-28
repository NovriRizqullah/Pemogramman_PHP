<!DOCTYPE html>
<html>
<head>
	<title>Form Tugas 2 PHP</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body>
<div class="container px-5 my-5">
    <form method="POST" id="contactForm" data-sb-form-api-token="API_TOKEN">
        <div class="form-floating mb-3">
            <input name="nama" class="form-control" id="namaPegawai" type="text" placeholder="Nama Pegawai" data-sb-validations="required" />
            <label for="namaPegawai">Nama Pegawai</label>
            <div class="invalid-feedback" data-sb-feedback="namaPegawai:required">Nama Pegawai is required.</div>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" name="agama" id="agama" aria-label="Agama">
                <option value="" disabled="" selected="">Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Budha">Budha</option>
                <option value="Hindu">Hindu</option>
                <option value="Konghucu">Konghucu</option>
            </select>
            <label for="agama">Agama</label>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Jabatan</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="manager" type="radio" name="jabatan" value="manager" data-sb-validations="required" />
                <label class="form-check-label" for="manager">Manager</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="asisten" type="radio" name="jabatan" value="asisten" data-sb-validations="required" />
                <label class="form-check-label" for="asisten">Asisten</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="kabag" type="radio" name="jabatan" value="kabag" data-sb-validations="required" />
                <label class="form-check-label" for="kabag">Kabag</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="staff" type="radio" name="jabatan" value="staff" data-sb-validations="required" />
                <label class="form-check-label" for="staff">Staff</label>
            </div>
            <div class="invalid-feedback" data-sb-feedback="jabatan:required">One option is required.</div>
        </div>
          <div class="mb-3">
            <label class="form-label d-block">Status</label>
        <div class="form-check form-check-inline">
                <input class="form-check-input" id="menikah" type="radio" name="status" value="menikah" data-sb-validations="required" />
                <label class="form-check-label" for="menikah">Menikah</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="BelumMenikah" type="radio" name="status" value="belum menikah" data-sb-validations="required" />
                <label class="form-check-label" for="BelumMenikah">Belum Menikah</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input name="jumlah_anak" class="form-control" id="jumlahAnak" type="text" placeholder="Jumlah Anak" data-sb-validations="required" />
            <label for="jumlahAnak">Jumlah Anak</label>
            <div class="invalid-feedback" data-sb-feedback="jumlahAnak:required">Jumlah Anak is required.</div>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" id="submitButton" name="proses" type="submit">Submit</button>
        </div>
    </form>
</div>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>


    <?php 
    $nama = $_POST['nama'];
    $agama = $_POST['agama'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $jumlah_anak = $_POST['jumlah_anak'];
    $tombol = $_POST['proses']; 
    
     // Menentukan Gaji Pokok:
    switch ($jabatan) {
            case 'manager': $gapok = 20000000; break;
            case 'asisten': $gapok = 15000000; break;
            case 'kabag': $gapok = 10000000; break;
            case 'staff': $gapok = 4000000; break;
            default:;
        }
    // Menentukan Tunjangan Jabatan: 
    $tunj_jabatan = 20 * $gapok / 100;

    
 //tentukan tunjangan keluarga
        if($status == 'menikah' && $jumlah_anak > 5) $tunj_keluarga = 15 * $gapok / 100;
        else if($status == 'menikah' && $jumlah_anak > 2 && $jumlah_anak <= 5) $tunj_keluarga = 10 * $gapok / 100;
        else if($status == 'menikah' && $jumlah_anak >= 0 && $jumlah_anak <= 2) $tunj_keluarga = 5 * $gapok / 100;
        else $tunj_keluarga = 0;
   
    // Menentukan Gaji Kotor:
     $gator = $gapok + $tunj_jabatan + $tunj_keluarga;

    // Menentukan Zakat Profesi (Ternary):
    if($agama == 'Islam' && $gator >= 6000000) $zakat_profesi = 2.5 * $gapok / 100;
    else $zakat_profesi = 0;

    // Menentukan Take Home Pay:
     $takehomepay = $gator - $zakat_profesi;

if(isset($tombol)){ ?>

    <br>
    <br>
    <div class="alert alert-primary" role="alert">
   
 Nama Pegawai: <?= $nama ?>
 <br> Agama : <?= $agama ?>
 <br> Jabatan : <?= $jabatan ?>
  <br> Status : <?= $status ?>
 <br> Jumlah Anak : <?= $jumlah_anak ?>
 <br>Gaji Pokok: <?= number_format($gapok, 0, ',', '.'); ?>
 <br>Tunjangan Jabatan: <?= number_format($tunj_jabatan, 0, ',', '.'); ?>
  <br> Tunjangan Keluarga: <?= number_format($tunj_keluarga,0, ',', '.'); ?>
   <br> Gaji Kotor: <?= number_format($gator,0, ',', '.'); ?>
   <br> Zakat Profesi (Ternary): <?= number_format($zakat_profesi,0, ',', '.'); ?>
   <br> Take Home Pay: <?= number_format($takehomepay,0, ',', '.'); ?>
 </div>
</div>
<?php }?>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

</body>
</html>