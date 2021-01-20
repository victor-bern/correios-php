const express = require('express');
const {rastrearEncomendas} = require('correios-brasil');


const app = express();

app.use(express.json());

app.get('/rastreio/:id', async function (req, res) {
    const {id} = req.params
    const encomenda = await rastrearEncomendas([id]).then((response) => response);
    if (encomenda[0].length === 0) {
        return res.send({Erro: "Objeto Não encontrado"});
    }

    return res.send(encomenda[0]);

})


app.listen(800);