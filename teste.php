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