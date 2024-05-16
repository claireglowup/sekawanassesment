<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <head>
        <nav class="navbar navbar-expand-lg bg-white border-bottom p-4">
            <div class="container-fluid">
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php

                        if (session()->get("role") === "approver") { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/inbox">Kotak Masuk</a>
                            </li>

                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="/car?type=truck">Mobil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/activity">Aktivitas</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </head>

    <main>

        <?= $this->renderSection('content'); ?>
    </main>

    <footer class="mt-5">
        <p class="text-center mt-3">Copyright 2024. PT Nikel Indonesia</p>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>