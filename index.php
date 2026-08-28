<?php

declare(strict_types=1);

require_once 'utilitarios.php';

$clientes = [

    [
        "nome" => "  ANA CLARA SILVA ",
        "cpf" => "123.456.789-00",
        "email" => "ana.clara@email.com",
        "contrato" => 1500.00,
        "ativo" => true
    ],

    [
        "nome" => "Carlos Souza",
        "cpf" => "987.654.321-00",
        "email" => "carlos.souza@email.com",
        "contrato" => 850.50,
        "ativo" => false
    ],

    [
        "nome" => "Maria Oliveira",
        "cpf" => "321.654.987-00",
        "email" => "maria.oliveira@email.com",
        "contrato" => 2200.00,
        "ativo" => true
    ],

    [
        "nome" => "Marcos Pereira",
        "cpf" => "456.789.123-00",
        "email" => "marcos.pereira@email.com",
        "contrato" => 1200.75,
        "ativo" => true
    ]

];

$clienteEncontrado = null;
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Buscar cliente
    if (isset($_POST["buscar"])) {

        $nome = trim((string) $_POST["nome"]);

        $clienteEncontrado = buscarCliente($clientes, $nome);

        if ($clienteEncontrado === null) {
            $mensagem = "Cliente não encontrado.";
        }
    }

    // Aplicar reajuste
    elseif (isset($_POST["reajustar"])) {

        $indice = (int) $_POST["indice"];
        $percentual = (float) $_POST["percentual"];

        if (isset($clientes[$indice]) && $percentual > 0) {

            aplicarReajuste(
                $clientes[$indice]["contrato"],
                $percentual
            );

            $mensagem = "Reajuste aplicado com sucesso.";

        } else {

            $mensagem = "Dados inválidos.";

        }
    }

    // Cadastrar novo cliente
    elseif (isset($_POST["cadastrar"])) {

        $nomeCadastro = trim((string) $_POST["nome_cadastro"]);
        $cpfCadastro = trim((string) $_POST["cpf_cadastro"]);
        $emailCadastro = trim((string) $_POST["email_cadastro"]);
        $contratoCadastro = (float) $_POST["contrato_cadastro"];

        if ($nomeCadastro === "") {

            $mensagem = "O nome é obrigatório.";

        } elseif (!validaCPF($cpfCadastro)) {

            $mensagem = "CPF inválido.";

        } elseif (!validaEmail($emailCadastro)) {

            $mensagem = "E-mail inválido.";

        } elseif ($contratoCadastro <= 0) {

            $mensagem = "O valor do contrato deve ser maior que zero.";

        } else {

            $novoCliente = [
                "nome" => formatarNome($nomeCadastro),
                "cpf" => limpaCPF($cpfCadastro),
                "email" => $emailCadastro,
                "contrato" => $contratoCadastro,
                "ativo" => true
            ];

            $clientes[] = $novoCliente;

            $mensagem = "Cliente cadastrado com sucesso.";
        }
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>CRM Senai</title>

    <style>

        body {
            margin: 0;
        }

        h1 {
            background-color: rgb(114, 29, 29);
            color: rgb(207, 145, 149);
            padding: 15px 30px;
            border-radius: 20px;
            text-align: center;
            margin: 20px;
        }

    </style>

</head>

<body style="background-color: rgb(255, 249, 225);">

<h1>CRM Senai</h1>


<?php if ($mensagem !== ""): ?>

    <p style="color: rgb(185, 162, 148);">
        <?= htmlspecialchars($mensagem) ?>
    </p>

<?php endif; ?>


<!-- Buscar cliente -->
<h2 style="
    color: rgb(170, 111, 126);
    background-color: rgb(238, 156, 177);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Buscar cliente
</h2>

<form method="post">

    <input
        type="text"
        name="nome"
        placeholder="Nome do cliente"
        required
    >

    <button
        style="color: rgb(185, 162, 148);"
        type="submit"
        name="buscar"
    >
        Buscar
    </button>

</form>


<?php if ($clienteEncontrado !== null): ?>

    <h2 style="
        color: rgb(238, 156, 177);
    ">
        Cliente encontrado
    </h2>

    <p style="color: rgb(185, 162, 148);">

        Nome:

        <?= formatarNome($clienteEncontrado["nome"]) ?>

    </p>

    <p style="color: rgb(185, 162, 148);">

        CPF:

        <?= $clienteEncontrado["cpf"] ?>

    </p>

    <p style="color: rgb(185, 162, 148);">

        E-mail:

        <?= htmlspecialchars($clienteEncontrado["email"]) ?>

    </p>

    <p style="color: rgb(185, 162, 148);">

        Contrato:

        <?= formatarMoeda((float) $clienteEncontrado["contrato"]) ?>

    </p>

    <p style="color: rgb(185, 162, 148);">

        Situação:

        <?= $clienteEncontrado["ativo"] ? "Ativo" : "Inativo" ?>

    </p>

<?php endif; ?>

<hr>

<!-- Cadastrar novo cliente -->
<h2 style="
    color: rgb(255, 248, 219);
    background-color: rgb(230, 223, 196);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Cadastrar novo cliente
</h2>

<form method="post">

    <p style="color: rgb(185, 162, 148);">

        <label for="nome_cadastro">
            Nome:
        </label>

        <input
            type="text"
            id="nome_cadastro"
            name="nome_cadastro"
            placeholder="Nome completo"
            required
        >

    </p>


    <p style="color: rgb(185, 162, 148);">

        <label for="cpf_cadastro">
            CPF:
        </label>

        <input
            type="text"
            id="cpf_cadastro"
            name="cpf_cadastro"
            placeholder="000.000.000-00"
            required
        >

    </p>


    <p style="color: rgb(185, 162, 148);">

        <label email_cadastro">
            E-mail:
        </label>

        <input
            type="email"
            id="email_cadastro"
            name="email_cadastro"
            placeholder="cliente@email.com"
            required
        >

    </p>


    <p style="color: rgb(185, 162, 148);">

        <label for="contrato_cadastro">
            Valor do contrato:
        </label>

        <input
            type="number"
            id="contrato_cadastro"
            name="contrato_cadastro"
            step="0.01"
            min="0.01"
            placeholder="0.00"
            required
        >

    </p>


    <button
        style="color: rgb(185, 162, 148);"
        type="submit"
        name="cadastrar"
    >
        Cadastrar cliente
    </button>

</form>


<!-- Lista de clientes cadastrados -->
<h2 style="
    color: rgb(255, 248, 219);
    background-color: rgb(230, 223, 196);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Clientes
</h2>

<table border="1">

    <tr style="color: rgb(238, 156, 177);">

        <th>Nome</th>

        <th>CPF</th>

        <th>E-mail</th>

        <th>Contrato</th>

        <th>Situação</th>

    </tr>


    <?php foreach ($clientes as $cliente): ?>

        <tr>

            <td style="color: rgb(185, 162, 148);">

                <?= formatarNome($cliente["nome"]) ?>

            </td>


            <td style="color: rgb(185, 162, 148);">

                <?= limpaCPF($cliente["cpf"]) ?>

            </td>


            <td style="color: rgb(185, 162, 148);">

                <?= htmlspecialchars($cliente["email"]) ?>

            </td>


            <td style="color: rgb(185, 162, 148);">

                <?= formatarMoeda((float) $cliente["contrato"]) ?>

            </td>


            <td style="color: rgb(185, 162, 148);">

                <?= $cliente["ativo"] ? "Ativo" : "Inativo" ?>

            </td>

        </tr>

    <?php endforeach; ?>

</table>


<!-- Resumo -->

<h2 style="
    color: rgb(255, 248, 219);
    background-color: rgb(230, 223, 196);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Resumo
</h2>


<p style="color: rgb(185, 162, 148);">

    Contratos ativos:

    <?= formatarMoeda(calcularTotalContratosAtivos($clientes)) ?>

</p>


<p style="color: rgb(185, 162, 148);">

    Média dos contratos:

    <?= formatarMoeda(calcularMediaContratos($clientes)) ?>

</p>


<p style="color: rgb(185, 162, 148);">

    Total de clientes:

    <?= count($clientes) ?>

</p>


<p style="color: rgb(185, 162, 148);">

    Clientes ativos:

    <?= contarClientesAtivos($clientes) ?>

</p>


<p style="color: rgb(185, 162, 148);">

    Maior contrato:

    <?= formatarMoeda(encontrarMaiorContrato($clientes)) ?>

</p>


<!-- reajuste -->
<hr>

<h2 style="
    color: rgb(255, 248, 219);
    background-color: rgb(230, 223, 196);
    padding: 10px 20px;
    border-radius: 15px;
    display: inline-block;
">
    Reajuste
</h2>


<form method="post">

    <select
        style="color: rgb(255, 176, 187);"
        name="indice"
    >

        <?php foreach ($clientes as $indice => $cliente): ?>

            <option value="<?= $indice ?>">

                <?= formatarNome($cliente["nome"]) ?>

            </option>

        <?php endforeach; ?>

    </select>


    <input
        type="number"
        name="percentual"
        step="0.01"
        min="0.01"
        placeholder="%"
        required
    >


    <button
        style="color: rgb(185, 162, 148);"
        type="submit"
        name="reajustar"
    >
        Aplicar reajuste
    </button>

</form>

</body>

</html>