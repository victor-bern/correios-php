<?php
/*
 * EMAIL
 */
define("EMAIL_SERVER", "smtp.sendgrid.net");
define("EMAIL_PORT", 587);
define("EMAIL_USERNAME", "apikey");
define("EMAIL_PASSWORD", "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");
define("EMAIL_SENDER", [
    "name" => "Victor",
    "adress" => "dartinjs@gmail.com"
]);
define("EMAIL_CHARSET", "utf-8");


/*
 * API
 */
define("API_URL", "http://localhost:800/rastreio/");
define("CSS_TABLE_EMAIL", "<style>
.rwd-table {
  margin: 1em 0;
  width: 500px;

}
tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }
body {
  padding: 0 2em;
  font-family: Montserrat, sans-serif;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  color: #444;
  background: #eee;
}

h1 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #34495E;
}

.rwd-table {
  background: #34495E;
  color: #fff;
  border-radius: .4em;
  overflow: hidden;
}

.dados {
float: left;
}
</style>");


function getHTML(string $css, string $body): string
{
    return stripcslashes("<!doctype html> 
<html lang='pt-BR'> 
    <head>
        {$css}
    </head >
    <body >
        <div id = 'wrapper' >
        <table class='rwd-table'>
        <thead>
                <tr>
                    <th>Data / Hora</th>
                    <th>Status / Localidade</th>
                </tr>
       </thead>
                {$body}
        </table>
        </div >
         <div class='dados'>
            <p>Dados do Envio</p>
            <p>Nome: Victor Bernardes da Silva Santos</p>
            <p>Tel: (75) 9 9256-9205</p>
            <p>Rua Inácio Bastos, n° 141, Bairro Silva Jardim</p>   
            <p>Alagoinhas/BA</p>    
        </div> 
    </body >
</html > ");
}