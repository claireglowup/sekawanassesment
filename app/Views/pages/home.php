<?= $this->extend("layout/layout.php"); ?>

<?= $this->section("content"); ?>


<?php if (session()->get('isLoggedIn')) { ?>
    <div class="container mt-5">
        <h1 class="text-center">
            Welcome, <?= session()->get("authorization") ?>
        </h1>
    </div>

<?php
} else {
?>

    <div class="container-fluid  p-5 border-bottom">
        <div class="container">
            <div class="jumbotron ">
                <h1 class="fw-bold fs-1 text-center" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Welcome back</h1>
                <div class="signup border p-4 m-auto mt-3 rounded" style="width: 400px;">
                    <form method="post" action="/login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-left">Username</label>
                            <input type="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" required value="<?php if (session()->get('usernameV')) :
                                                                                                                                                                    echo session()->get('usernameV');
                                                                                                                                                                endif; ?>">
                            <div id="emailHelp" class="form-text"> <?php if (session()->get('username')) : ?>
                                    <p style="color: red;">Username tidak ditemukan</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required value="<?php if (session()->get('passwordV')) :
                                                                                                                                        echo session()->get('passwordV');
                                                                                                                                    endif; ?>">
                            <div class="form-text"> <?php if (session()->get('password')) : ?>
                                    <p style="color: red;">Password Salah</p>
                                <?php endif; ?>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Log in</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php } ?>
<?= $this->endSection(); ?>