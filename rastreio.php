<?php

require __DIR__ . "/vendor/autoload.php";

session_start();

$mailer = new \Source\Classes\Email();
$pdf = new \Mpdf\Mpdf();


if (empty($_POST['objeto']) || empty($_POST['email'])) {
    \Source\Classes\Message::add(["Erro" => "Campos vazios"]);
    header("location: index.php");
}

$objeto = $_POST['objeto'];
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$rastreio = new \Source\Classes\Rastreio($objeto);
$dados = $rastreio->getObjectInfo();
$_SESSION['dados'] = $dados;

if ($email) {
    \Source\Classes\Message::add(["Erro" => "Formato de Email inválido"]);
    header("location: http://localhost/correios/");
}

$subjectsMessage = [
    "postado" => "O objeto foi Postado",
    "em trânsito" => "Objeto à caminho",
    "entregue" => "Objeto Entregue",
    "Falha" => "Houve falha ao entregar Objeto",

];

$HtmlBody = "";
$arrayReversed = array_reverse($dados);
foreach ($arrayReversed as $dado) {
    $local = $dado->local ?? $dado->destino;
    $localidade = isset($dado->origem) ? explode(" - ", $dado->origem)[1] : explode(" - ", $dado->local)[1];
    $HtmlBody .= "<tbody>
                      <tr>
                        <td>{$dado->data}<br>{$dado->hora}<br>
                            <label>{$localidade}</label>
                        </td>
                        <td>
                            <strong>{$dado->status}</strong><br>
                                    Registrado por {$local}
                        </td>
                     </tr>
                  </tbody>
                 ";
}

$html = getHTML(CSS_TABLE_EMAIL, $HtmlBody);
$pdf->WriteHTML($html);
$nameFile = "Relatorio" . (new DateTime())->getTimestamp();
$pdf->Output(__DIR__ . "/source/Uploads/pdf/{$nameFile}.pdf", \Mpdf\Output\Destination::FILE);

foreach ($subjectsMessage as $key => $value) {
    $lastIndex = count($dados) - 1;
    if (!!strstr($dados[$lastIndex]->status, $key)) {
        $mailer->boostrap($value, $html, $email, "Lailson")->attach(__DIR__ . "/source/Uploads/pdf/{$nameFile}.pdf", "PDF");
        $_SESSION['email'] = $email;
        echo $mailer->send();
        header("location: sucesso.php");
        return null;
    }
}
