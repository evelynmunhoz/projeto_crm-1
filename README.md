# projeto_crm
**Desafio:** 
 Desenvolver uma aplicação PHP capaz de cadastrar clientes, limpar e formatar seus dados, calcular o valor dos contratos e gerar um relatório resumido. O projeto deverá ser dividido em funções reutilizáveis, evitando a repetição de lógica.
O sistema deve funcionar com dados simulados em arrays. Não é necessário utilizar banco de dados ou autenticação.

 Utilizamos:
 ```php 
<?php

declare(strict_types=1);

require_once 'utilitarios.php';

$clientes = [
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    [
        "nome" => "  ANA CLARA SILVA ",
        "cpf" => "123.456.789-00",
        "email" => "ana.clara@email.com",
        "contrato" => 1500.00,
        "ativo" => true
    ],
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    [
        "nome" => "Carlos Souza",
        "cpf" => "987.654.321-00",
        "email" => "carlos.souza@email.com",
        "contrato" => 850.50,
        "ativo" => false
    ],
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    [
        "nome" => "Maria Oliveira",
        "cpf" => "321.654.987-00",
        "email" => "maria.oliveira@email.com",
        "contrato" => 2200.00,
        "ativo" => true
    ],
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    [
        "nome" => "Marcos Pereira",
        "cpf" => "456.789.123-00",
        "email" => "marcos.pereira@email.com",
        "contrato" => 1200.75,
        "ativo" => true
    ]
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
];

$clienteEncontrado = null;
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Buscar cliente
    if (isset($_POST["buscar"])) {

        $nome = trim((string) $_POST["nome"]);
<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
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
<<<<<<< HEAD
            $mensagem = "Dados inválidos.";
=======

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
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
        }
    }
}

?>

<!DOCTYPE html>
<<<<<<< HEAD
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>CRM Senai</title>
</head>

<body>

<h1>CRM Senai</h1>

<?php if ($mensagem !== ""): ?>
    <p><?= htmlspecialchars($mensagem) ?></p>
<?php endif; ?>


<h2>Buscar cliente</h2>
=======

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
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3

<form method="post">

    <input
        type="text"
        name="nome"
        placeholder="Nome do cliente"
        required
    >

<<<<<<< HEAD
    <button type="submit" name="buscar">
=======
    <button
        style="color: rgb(185, 162, 148);"
        type="submit"
        name="buscar"
    >
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
        Buscar
    </button>

</form>


<?php if ($clienteEncontrado !== null): ?>

<<<<<<< HEAD
    <h3>Cliente encontrado</h3>

    <p>
        Nome:
        <?= formatarNome($clienteEncontrado["nome"]) ?>
    </p>

    <p>
        CPF:
        <?= $clienteEncontrado["cpf"] ?>
    </p>

    <p>
        E-mail:
        <?= $clienteEncontrado["email"] ?>
    </p>

    <p>
        Contrato:
        <?= formatarMoeda((float) $clienteEncontrado["contrato"]) ?>
    </p>

    <p>
        Situação:
        <?= $clienteEncontrado["ativo"] ? "Ativo" : "Inativo" ?>
=======
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

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    </p>

<?php endif; ?>

<<<<<<< HEAD

<h2>Clientes</h2>

<table border="1">

    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>E-mail</th>
        <th>Contrato</th>
        <th>Situação</th>
    </tr>

=======
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


>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    <?php foreach ($clientes as $cliente): ?>

        <tr>

<<<<<<< HEAD
            <td>
                <?= formatarNome($cliente["nome"]) ?>
            </td>

            <td>
                <?= limpaCPF($cliente["cpf"]) ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente["email"]) ?>
            </td>

            <td>
                <?= formatarMoeda((float) $cliente["contrato"]) ?>
            </td>

            <td>
                <?= $cliente["ativo"] ? "Ativo" : "Inativo" ?>
=======
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

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
            </td>

        </tr>

    <?php endforeach; ?>

</table>


<<<<<<< HEAD
<h2>Resumo</h2>

<p>
    Contratos ativos:
    <?= formatarMoeda(calcularTotalContratosAtivos($clientes)) ?>
</p>

<p>
    Média dos contratos:
    <?= formatarMoeda(calcularMediaContratos($clientes)) ?>
</p>

<p>
    Total de clientes:
    <?= count($clientes) ?>
</p>

<p>
    Clientes ativos:
    <?= contarClientesAtivos($clientes) ?>
</p>

<p>
    Maior contrato:
    <?= formatarMoeda(encontrarMaiorContrato($clientes)) ?>
</p>


<h2>Reajuste</h2>

<form method="post">

    <select name="indice">
=======
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
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3

        <?php foreach ($clientes as $indice => $cliente): ?>

            <option value="<?= $indice ?>">
<<<<<<< HEAD
                <?= formatarNome($cliente["nome"]) ?>
=======

                <?= formatarNome($cliente["nome"]) ?>

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
            </option>

        <?php endforeach; ?>

    </select>

<<<<<<< HEAD
=======

>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
    <input
        type="number"
        name="percentual"
        step="0.01"
        min="0.01"
        placeholder="%"
        required
    >

<<<<<<< HEAD
    <button type="submit" name="reajustar">
=======

    <button
        style="color: rgb(185, 162, 148);"
        type="submit"
        name="reajustar"
    >
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
        Aplicar reajuste
    </button>

</form>

</body>
<<<<<<< HEAD
</html>
```
=======

</html>
```


>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
Para executar a atividade.

Entretanto, tivemos alguns testes. Entre eles:

```php 
<?php

declare(strict_types=1);

require_once 'utilitarios.php';

// Função para mostrar o resultado de cada teste
function mostrarResultado(string $nomeTeste, bool $resultado): void
{
    if ($resultado) {
        echo "<p style='color: green;'>PASSOU: $nomeTeste</p>";
    } else {
        echo "<p style='color: red;'>FALHOU: $nomeTeste</p>";
    }
}

echo "<h1>Testes do Projeto CRM Senai</h1>";


// Clientes utilizados nos testes
$clientesTeste = [
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
    ]
];


// TESTE 1 - FORMATAÇÃO DO NOME
$nome = formatarNome("  ANA CLARA SILVA ");

mostrarResultado(
    "Formatação do nome",
    $nome === "Ana Clara Silva"
);


// TESTE 2 - LIMPEZA DO CPF
$cpf = limpaCPF("123.456.789-00");

mostrarResultado(
    "Limpeza do CPF",
    $cpf === "12345678900"
);


// TESTE 3 - CPF VÁLIDO
$cpfValido = validaCPF("123.456.789-00");

mostrarResultado(
    "Validação de CPF com 11 caracteres",
    $cpfValido === true
);


// TESTE 4 - CPF INVÁLIDO
$cpfInvalido = validaCPF("123.456");

mostrarResultado(
    "Validação de CPF inválido",
    $cpfInvalido === false
);


// TESTE 5 - E-MAIL VÁLIDO
$emailValido = validaEmail("ana.clara@email.com");

mostrarResultado(
    "Validação de e-mail válido",
    $emailValido === true
);


// TESTE 6 - E-MAIL INVÁLIDO
$emailInvalido = validaEmail("email-invalido");

mostrarResultado(
    "Validação de e-mail inválido",
    $emailInvalido === false
);


// TESTE 7 - E-MAIL VAZIO
$emailVazio = validaEmail("   ");

mostrarResultado(
    "Validação de e-mail vazio",
    $emailVazio === false
);


// TESTE 8 - FORMATAÇÃO DE MOEDA
$moeda = formatarMoeda(1500.00);

mostrarResultado(
    "Formatação de moeda brasileira",
    $moeda === "R$ 1.500,00"
);


// TESTE 9 - BUSCA DE CLIENTE EXISTENTE
$clienteEncontrado = buscarCliente(
    $clientesTeste,
    "Ana Clara Silva"
);

mostrarResultado(
    "Busca de cliente existente",
    $clienteEncontrado !== null
);


// TESTE 10 - BUSCA DE CLIENTE INEXISTENTE
$clienteNaoEncontrado = buscarCliente(
    $clientesTeste,
    "João Inexistente"
);

mostrarResultado(
    "Busca de cliente inexistente",
    $clienteNaoEncontrado === null
);


// TESTE 11 - TOTAL DOS CONTRATOS ATIVOS
$totalAtivos = calcularTotalContratosAtivos($clientesTeste);

mostrarResultado(
    "Cálculo do total dos contratos ativos",
    $totalAtivos === 3700.00
);


// TESTE 12 - MÉDIA DOS CONTRATOS
$media = calcularMediaContratos($clientesTeste);

mostrarResultado(
    "Cálculo da média dos contratos",
    abs($media - 1516.8333333333) < 0.01
);


// TESTE 13 - CONTAGEM DE CLIENTES ATIVOS
$ativos = contarClientesAtivos($clientesTeste);

mostrarResultado(
    "Contagem de clientes ativos",
    $ativos === 2
);


// TESTE 14 - REAJUSTE DE CONTRATO
$contrato = 1000.00;

aplicarReajuste($contrato, 10.0);

mostrarResultado(
    "Aplicação de reajuste de 10%",
    $contrato === 1100.00
);


// TESTE 15 - MAIOR CONTRATO
$maiorContrato = encontrarMaiorContrato($clientesTeste);

mostrarResultado(
    "Identificação do maior contrato",
    $maiorContrato === 2200.00
);


// TESTE 16 - LISTA VAZIA NA MÉDIA
$clientesVazios = [];

$mediaVazia = calcularMediaContratos($clientesVazios);

mostrarResultado(
    "Média de contratos com lista vazia",
    $mediaVazia === 0.0
);


echo "<hr>";

echo "<h2>Fim dos testes</h2>";

?>
```
** Etapas de desenvolvimento**

- *Planejamento*: Assim que formamos os grupos, criamos um chat na plataforma classroom para o compartilhamento de informações, das quais todas deveriam ter acesso. 
Tivemos algumas idéias para criação de site e resolvemos testa-las e armazenar em um arquivo chamado *teste.php*

- *Moldagem dos dados:* Definimos o formato de uma estrutura de dados usada para armazenar vários valores em uma única variável (array) de um cliente e os campos obrigatórios para executar a atividade.

- *Construção da biblioteca:* Adicionamos testes em *utilitarios.php* 

- *integração:* Em *index.php* Importamos os códigos necessários para executar a biblioteca em uma tabela HTML

- *Testes:* Tivemos vários testes antes de executar o programa, adicionamos os códigos que mais impactaram na criação da biblioteca

- *Parte final:* 

**Ana Clara**: Desenvolvedora da biblioteca e Testadora: implementa as funções de tratamento e cálculo, registra os resultados e prepara o README.md.

**Camile**: Desenvolvedor da interface e Analista: monta a tela HTML, integra as funções, descreve os requisitos e prepara os casos de teste.

**Evelyn**: Documentadora e Analista: registra os resultados, prepara o README.md, descreve os requisitos e prepara os casos de teste.

### Perguntas para reflexão:

1. **Validações e formatações dos dados**, pois teríamos que corrigir o código em vários lugares.

2. Porque `null` indica que **nenhum cliente foi encontrado**.

3. Foi usado no **reajuste do contrato** para alterar o valor original. Sem `&`, o valor original não seria alterado.

4. A tipagem ajuda a **evitar erros nos tipos de dados** recebidos e retornados pelas funções.

<<<<<<< HEAD
5. Uma função para **formatar o CPF**, evitando repetir esse código.

=======
5. Uma função para **formatar o CPF**, evitando repetir esse código.
>>>>>>> 05240105955593b7d5748e54dd664b023b431ba3
