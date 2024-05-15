<?= $this->extend("layout/layout.php"); ?>

<?= $this->section("content"); ?>
<div class="container-fluid  p-5 border-bottom">
    <div class="container">
        <div class="jumbotron ">
            <h1 class="fw-bold fs-1 text-center" style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Log in</h1>
            <div class="signup border p-4 m-auto mt-3 rounded" style="width: 400px;">
                <form method="post" action="/login">

                    <div class="mb-3">
                        <label for="username" class="form-label text-left">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>