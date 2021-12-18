<?php include './includes/db.php' ?>
<!DOCTYPE html>
<html>
    <head>
        <title>URL Shortener Sederhana</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/style.css" />
    </head>
    <body>
        <div class="url-shortener">
            <div class="title">
                <h1>URL Shortener</h1>
            </div>
            <div class="deskripsi">
                <p>Masukan link yang ingin diperpendek di form yang ada di bawah ini.</p>
            </div>

            <div class="form">
                <form method="post">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text"><i class="bi bi-link-45deg icons"></i></span>
                        <input type="url" name="url" class="form-control" placeholder="Masukan Link Disini ..." value="<?=(isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '')?>">
                        <button class="btn btn-primary" name="submit"><i class="bi bi-arrow-right"></i></button>
                    </div>
                </form>
                
                <?php include './includes/url_submit.php' ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const salinLink = document.getElementById('salin-link');
            salinLink.addEventListener('click', (e) =>
            {
                e.preventDefault();

                const cop = document.createElement('textarea');
                cop.value = document.getElementById('url-short').textContent;
                document.body.appendChild(cop);
                cop.select();
                document.execCommand('copy');
                document.body.removeChild(cop);

                salinLink.text = 'Link disalin';

                setTimeout(() => {salinLink.text = 'Salin'}, 2000);
            });
        </script>
    </body>
</html>