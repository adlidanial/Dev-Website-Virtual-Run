<!DOCTYPE html>
<html>

<head>
    <?php include '../app/includes/header.php'; ?>
    <title>Log Masuk - Virtual Run</title>
</head>

<body>
<?php include '../app/includes/user-navbar.php'; ?>
    <main class="page contact-page">
        <section class="portfolio-block contact">
            <div class="container">
                <div class="heading">
                    <h2>LOG MASUK</h2>
                </div>
                <form class="bg-white" method="post" action="//<?php echo URLROOT ?>/admin">
                    <div class="form-group">
                        <label for="name">Kata Nama</label>
                        <input class="form-control item" type="text" name="katanama">
                    </div>
                    <div class="form-group">
                        <label for="subject">Kata Laluan</label>
                        <input class="form-control item" type="password" name="katalaluan">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block btn-lg border rounded" type="submit" name="btnHantar">Log Masuk</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <?php include '../app/includes/user-footer.php'; ?>
</body>

</html>