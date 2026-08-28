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
}

?>

<!DOCTYPE html>
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

<form method="post">

    <input
        type="text"
        name="nome"
        placeholder="Nome do cliente"
        required
    >

    <button type="submit" name="buscar">
        Buscar
    </button>

</form>


<?php if ($clienteEncontrado !== null): ?>

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
    </p>

<?php endif; ?>


<h2>Clientes</h2>

<table border="1">

    <tr>
        <th>Nome</th>
        <th>CPF</th>
        <th>E-mail</th>
        <th>Contrato</th>
        <th>Situação</th>
    </tr>

    <?php foreach ($clientes as $cliente): ?>

        <tr>

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
            </td>

        </tr>

    <?php endforeach; ?>

</table>


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

    <button type="submit" name="reajustar">
        Aplicar reajuste
    </button>

</form>

</body>
</html>
```
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

5. Uma função para **formatar o CPF**, evitando repetir esse código.

