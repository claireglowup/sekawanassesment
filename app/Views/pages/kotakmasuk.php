<?= $this->extend("layout/layout.php"); ?>
<?= $this->section("content"); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h1>Kotak Masuk</h1>
        <h1><?= session()->get("authorization") ?></h1>
    </div>
</div>
<div class="container mt-3">
    <ul class="list-group">

        <?php foreach ($orders as $order) : ?>
            <li class="list-group-item">
                <div class="d-flex justify-content-between">
                    <h2 class="text-capitalize"><?= $order->name ?></h2>
                    <p class="fw-semibold"><?= $order->time ?></p>
                </div>
                <p class="text-capitalize fw-bold"><?= $order->nama_pegawai ?></p>
                <p class="text-capitalize"><?= $order->jabatan_pegawai ?></p>
                <div class="d-flex justify-content-between">
                    <p class="text-capitalize">Estimasi Jarak <?= $order->estimasi_jarak ?>km</p>
                    <div class="buttongrp">
                        <button class="btn btn-outline-success">Approve</button>
                        <button class="btn btn-outline-danger">Reject</button>

                    </div>
                </div>


            </li>
        <?php endforeach ?>
    </ul>
</div>

<?= $this->endSection(); ?>