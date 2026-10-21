<?php

class Chamado
{
    // READ - Ler todos os chamados 
    public function lerChamados()
    {
        $arquivo = __DIR__ . "/../dados/chamados.json";

        // Vereficação se o arquivo .json já existe
        if (!file_exists($arquivo)) {
            file_put_contents($arquivo, "[]");
        }

        // Ler o arquivo
        $conteudo = file_get_contents($arquivo);

        // Converter o JSON para ARRAY PHP
        $chamados = json_decode($conteudo, true);

        return is_array($chamados) ? $chamados : [];
    }

    // Salvar os chamados de JSON
    public function salvarChamados($chamados)
    {
        $arquivo = __DIR__ . "/../projetos/chamados.json";

        return file_put_contents(
            $arquivo,
            json_encode($chamados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        ) !== false;
    }

    // CREATE - Cadastrar chamados
    public function cadastrarChamados($nome, $setor, $equipamento, $descricao, $prioridade)
    {
        if (trim($nome) === "" || trim($descricao) == "") {
            return false;
        }

        $chamados = $this->lerChamados();

        $novoChamado = [
            "nome" => trim($nome),
            "setor" => $setor,
            "equipameto" => $equipamento,
            "descricao" => trim($descricao),
            "prioridade" => $prioridade,
            "status" => "Aberto"
        ];

        $chamados[] = $novoChamado;

        return $this->salvarChamados($chamados);
    }

    // UPTADE - Atualizar status do chamado
    public function atualizarChamado($posicao, $novoStatus)
    {
        $chamados = $this->lerChamados();

        //Listar status do chamado
        $statusPermitidos = [
            "Aberto",
            "Em andamento",
            "Resolvido"
        ];

        // isset() verifica se uma variável ou posição existe e não contém null.
        // O ! o inverte o resultado.
        // Portanto:
        // Se não existir um chamado naquela posição, encerra o processo retornando false.
        if (!isset($chamados[$posicao])) {
            return false;
        }

        // in_array() verifica se um valor existe dentro de um array.
        // Nesse caso:
        // - $novoStatus: valor que queremos procurar.
        // - $statusPermitidos: lista de valores aceitos.
        // - true: exige comparação estrita.
        // O ! significa que a condição será verdadeira quando o valor não estiver na lista.
        if (!in_array($novoStatus, $statusPermitidos, true)) {
            return false;
        }

        $chamados[$posicao]["status"] = "Resolvido";

        return $this->salvarChamados($chamados);
    }

    // DELETE - Excluir chamados
    public function excluirChamado($posicao)
    {
        $chamados = $this->lerChamados();
        if (!isset($chamados[$posicao])) {
            return false;
        }

        unset($chamados[$posicao]);

        $chamados = array_values($chamados);

        return $this->salvarChamados($chamados);
    }

    // Relatório de atendimentos
    public function gerarRelatorios()
    {
        $chamados = $this->lerChamados();

        $relatorio = [
            "total" => count($chamados),
            "abertos" => 0,
            "andamento" => 0,
            "resolvidos" => 0
        ];

        foreach ($chamados as $chamado) {
            if ($chamado["status"] === "Aberto") {
                $relatorio["abertos"]++;
            } elseif ($chamado["status"] === "Em andamento") {
                $relatorio["andamento"]++;
            } elseif ($chamado["status"] === "Resolvido") {
                $relatorio["resolvidos"]++;
            }
        }
        return $relatorio;
    }
}

?>