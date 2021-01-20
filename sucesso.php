<!doctype html>
<html lang="pt-BR">
<?php session_start(); ?>

<?php if (!isset($_SESSION['dados'])): ?>
    <?php header("location: http://localhost/correios/"); ?>
<?php endif; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    </style>
    <link rel="stylesheet" href="assets/style.scss">
    <title>Sucesso</title>
</head>
<?php $dados = array_reverse($_SESSION['dados']); ?>
<body>
<h1 style="text-align: center">Um email foi enviado para você com um PDF anexado</h1>
<div class="wrapper">
    <table class='rwd-table'>
        <thead>
        <tr>
            <th>Data / Hora</th>
            <th>Status / Localidade</th>
        </tr>
        </thead>
        <?php foreach ($dados as $dado): ?>
            <?php $local = $dado->local ?? $dado->destino; ?>
            <?php $localidade = isset($dado->origem) ? explode(" - ", $dado->origem)[1] : explode(" - ", $dado->local)[1] ?>
            <tbody>
            <tr>
                <td><?= $dado->data ?><br><?= $dado->hora; ?><br>
                    <label><?= $localidade ?></label>
                </td>
                <td>
                    <strong><?= $dado->status; ?></strong><br>
                    Registrado por <?= $local ?>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
    <div class='dados'>
        <p>Dados do Envio</p>
        <p>Nome: Victor Bernardes da Silva Santos</p>
        <p>Tel: (75) 9 9256-9205</p>
        <p>Rua Inácio Bastos, n° 141, Bairro Silva Jardim</p>
        <p>Alagoinhas/BA</p>
    </div>
</div>

<?php unset($_SESSION['dados']) ?>
</body>

</html>