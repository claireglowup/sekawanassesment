<?= $this->extend("layout/layout.php"); ?>
<?= $this->section("content"); ?>

<div class="container mt-4 truck-car">
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card" style="width: 100%;">
                <img src="<?= $car['img'] ?>" class="card-img-top" alt="truck">
                <div class="card-body">
                    <h2><?= $car['name'] ?></h2>
                    <div class=" d-flex justify-content-between">
                        <p>Bahan bakar</p>
                        <p><?= $car['oil'] ?>km/liter</p>
                    </div>
                    <div class=" d-flex justify-content-between">
                        <p>Riwayat perjalanan</p>
                        <p><?= $car['kilometer'] ?>km</p>
                    </div>
                    <div class=" d-flex justify-content-between">
                        <p>Anjuran service</p>
                        <p> <?= $car['service_km'] ?>km/service</p>
                    </div>
                    <div class=" d-flex justify-content-between">
                        <?php switch ($car['available']) {
                            case 1:
                                echo '<span class="btn btn-outline-success">Tersedia</span>';
                                break;
                            case 2:
                                echo '<span class="btn btn-outline-warning">Service</span>';
                                break;
                            case 3:
                                echo '<span class="btn btn-outline-">Dipakai</span>';
                                break;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="container-sm">
    <form action="/order?idcar=<?= $car["id"] ?>" method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" name="namap" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="jabatan" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estimasi Jarak Perjalanan (KM)</label>
            <input type="number" class="form-control" id="exampleInputPassword1" name="kilometer" required min=1>
        </div>
        <div class="mb-3">
            <select class="form-select" aria-label="Default select example" name="approver" required>
                <option value="" selected disabled>Pilih Approver</option>
                <?php foreach ($approvers as $approver) : ?>
                    <option value="<?= $approver["id"] ?>"><?= $approver["username"] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan</button>
        <a href="/car?type=truck" class="btn btn-danger">Batal</a>

    </form>
</div>


<?= $this->endSection(); ?>