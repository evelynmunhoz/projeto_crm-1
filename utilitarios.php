<?php

    declare(strict_types=1);

//Formatação do nome do Cliente

 function formatarNome(string $nome): string
{
 //remove espaços desnecessários
 $nome = trim($nome);

 //deixa o nome com letras maiúsculas
 $nome = strtolower($nome);

 //coloca a primeira letra de cada palavra em maiúscula
 $nome = ucwords($nome);

 return $nome;

}

//Remove pontuação do CPF

function limpaCPF(string $cpf): string

{
    $cpf = str_replace(".","", $cpf);
    $cpf = str_replace("-", "", $cpf);

    return $cpf;

}

// Confirma/valida se o CPF possui 11 caracteres

function validaCPF(string $cpf): bool
{
    $cpf = limpaCPF($cpf);

    if (strlen($cpf)== 11){
        return true;
    } else{
        return false;

    }

}
// Valida o formato do e-mail

function validaEmail(string $email): bool
{
    if (strlen(trim($email))== 0) {
        return false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else{
        return true;
    }
}

// Formata o valor para moeda brasileira
function formatarMoeda(float $valor): string
{
    return "R$ " . number_format($valor, 2, ",", ".");
}

// Busca um cliente pelo nome
function buscarCliente(array $clientes, string $nome): ?array
{
    foreach ($clientes as $cliente) {
        if (strtolower(trim($cliente["nome"])) == strtolower(trim($nome))) {
            return $cliente;
        }
    }

    return null;
}

// Calcula o total dos contratos dos clientes ativos
function calcularTotalContratosAtivos(array $clientes): float
{
    $total = 0;

    foreach ($clientes as $cliente) {
        if ($cliente["ativo"] == true) {
            $total += $cliente["contrato"];
        }
    }

    return $total;
}

// Calcula a média dos contratos
function calcularMediaContratos(array $clientes): float
{
    if (count($clientes) == 0) {
        return 0;
    }

    $total = 0;

    foreach ($clientes as $cliente) {
        $total += $cliente["contrato"];
    }

    return $total / count($clientes);
}

// Conta quantos clientes estão ativos
function contarClientesAtivos(array $clientes): int
{
    $quantidade = 0;

    foreach ($clientes as $cliente) {
        if ($cliente["ativo"] == true) {
            $quantidade++;
        }
    }

    return $quantidade;
}

// Aplica um reajuste no contrato original
function aplicarReajuste(float &$contrato, float $percentual): void
{
    $contrato = $contrato + ($contrato * $percentual / 100);
}

// Encontra o maior contrato cadastrado
function encontrarMaiorContrato(array $clientes): float
{
    $maior = 0;

    foreach ($clientes as $cliente) {
        if ($cliente["contrato"] > $maior) {
            $maior = $cliente["contrato"];
        }
    }

    return $maior;
}



?>