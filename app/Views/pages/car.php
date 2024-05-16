<?= $this->extend("layout/layout.php"); ?>
<?= $this->section("content"); ?>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-white border-bottom p-4">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link <?= $type == 'truck' ? 'fw-bold' : '' ?>" href="/car?type=truck">Angkutan barang</a>
                    </li>
                    <li class="nav-item <?= $type == 'general' ? 'fw-bold' : '' ?>">
                        <a class="nav-link" href="/car?type=general">Angkutan orang</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container mt-4 truck-car">
    <div class="row">
        <?php foreach ($cars as $car) : ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <img src="<?= $car['img'] ?>" class="card-img-top" alt="truck">
                    <div class="card-body">
                        <h5 class="card-title"><?= $car['name'] ?></h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, impedit?</p>
                        <a href="/order?id=<?= $car['id'] ?>" class="btn btn-primary">Ajukan</a>
                        <span class="btn btn-outline-success">Tersedia</span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





<?= $this->endSection();
