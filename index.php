<!doctype html>
<html lang="pt_br">
<?php session_start(); ?>
<?php require __DIR__ . "/vendor/autoload.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .formulario {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 200px;
        }

        .email {
            margin-left: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Rastreio de Objeto</title>
</head>

<body>
<h1 style="text-align: center">Rastreio de Objetos</h1>
<form action="rastreio.php" method="post" class="formulario">
    <div class="mb-3">
        <label for="Objeto" class="form-label">Objeto</label>
        <input type="text" id="Objeto" name="objeto" class="form-control" placeholder="Objeto">
    </div>
    <div class="mb-3 email">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top: 13px; margin-left: 10px;">Enviar
    </button>
</form>
<?php if (isset($_SESSION['flash'])): ?>
    <div style=" width: 150px ;margin: 0 auto">
        <span class="badge bg-danger"><?= \Source\Classes\Message::get()['Erro'] ?></span>
    </div>
<?php endif; ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous">
</script>
</body>

</html>