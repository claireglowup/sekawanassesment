<?= $this->extend("layout/layout.php"); ?>
<?= $this->section("content"); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h1>Aktivitas</h1>
        <h1><?= session()->get("authorization") ?></h1>
    </div>
    <hr>
</div>
<div class="container mt-3">
    <ul class="list-group">
        <h1>Berlangsung</h1>
        <hr>
        <?php foreach ($orders as $order) :
            if ($order->action != 1) {
        ?>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-capitalize"><?= $order->name ?></h2>
                        <p class="fw-semibold"><?= $order->time ?></p>
                    </div>
                    <p class="text-capitalize fw-bold"><?= $order->nama_pegawai ?></p>
                    <p class="text-capitalize"><?= $order->jabatan_pegawai ?></p>
                    <p class="text-capitalize">Estimasi Jarak <?= $order->estimasi_jarak ?>km</p>
                    <div class="d-flex justify-content-between">
                        <p class="fw-medium"><?= $order->username ?></p>
                        <span class="btn btn-outline-warning">Diproses</span>
                    </div>
                </li>
        <?php }
        endforeach ?>

        <h1 class="mt-3">History</h1>
        <hr>

        <?php foreach ($orders as $order) :
            if ($order->action == 1) {
        ?>
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <h2 class="text-capitalize"><?= $order->name ?></h2>
                        <p class="fw-semibold"><?= $order->time ?></p>
                    </div>
                    <p class="text-capitalize fw-bold"><?= $order->nama_pegawai ?></p>
                    <p class="text-capitalize"><?= $order->jabatan_pegawai ?></p>
                    <p class="text-capitalize">Estimasi Jarak <?= $order->estimasi_jarak ?>km</p>
                    <div class="d-flex justify-content-between">
                        <p class="fw-medium"><?= $order->username ?></p>
                        <?php if ($order->approved === "Approved") { ?>
                            <span class="btn btn-outline-success">Approved</span>
                        <?php } else if ($order->approved === "Rejected") { ?>
                            <span class="btn btn-outline-danger">Rejected</span>
                        <?php } ?>
                    </div>
                </li>
        <?php }
        endforeach ?>


    </ul>
</div>

<?= $this->endSection(); ?>