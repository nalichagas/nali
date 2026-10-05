<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas do Aluno</title>
    <link rel="stylesheet" href="/css/notas.css">
</head>

<body>

<div class="card">

    <h1>Notas do Aluno</h1>

    <form method="POST" action="notas-desafio.php">
        <div>
            <label for="nome">Nome do aluno:</label>
            <input
                type="text"
                id="nome"
                name="nome"
                required
                value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="idade">Idade:</label>
            <input
                type="number"
                id="idade"
                name="idade"
                min="0"
                required
                value="<?= htmlspecialchars($_POST['idade'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nota1">Nota 1 (Peso 2):</label>
            <input
                type="number"
                id="nota1"
                name="nota1"
                min="0"
                max="10"
                step="0.1"
                required
                value="<?= htmlspecialchars($_POST['nota1'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nota2">Nota 2 (Peso 3):</label>
            <input
                type="number"
                id="nota2"
                name="nota2"
                min="0"
                max="10"
                step="0.1"
                required
                value="<?= htmlspecialchars($_POST['nota2'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nota3">Nota 3 (Peso 1):</label>
            <input
                type="number"
                id="nota3"
                name="nota3"
                min="0"
                max="10"
                step="0.1"
                required
                value="<?= htmlspecialchars($_POST['nota3'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nota4">Nota 4 (Peso 1):</label>
            <input
                type="number"
                id="nota4"
                name="nota4"
                min="0"
                max="10"
                step="0.1"
                required
                value="<?= htmlspecialchars($_POST['nota4'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="nota5">Nota 5 (Peso 3):</label>
            <input
                type="number"
                id="nota5"
                name="nota5"
                min="0"
                max="10"
                step="0.1"
                required
                value="<?= htmlspecialchars($_POST['nota5'] ?? '') ?>"
            >
        </div>

        <button type="submit">Calcular média</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = trim($_POST["nome"] ?? '');
        $idade = (int) ($_POST["idade"] ?? 0);
        $nota1 = (float) ($_POST["nota1"] ?? 0);
        $nota2 = (float) ($_POST["nota2"] ?? 0);
        $nota3 = (float) ($_POST["nota3"] ?? 0);
        $nota4 = (float) ($_POST["nota4"] ?? 0);
        $nota5 = (float) ($_POST["nota5"] ?? 0);

        $media = (
            ($nota1 * 2) +
            ($nota2 * 3) +
            ($nota3 * 1) +
            ($nota4 * 1) +
            ($nota5 * 3)
        ) / 10;

        if ($media >= 7) {
            $situacao = "APROVADO";
            $classeSituacao = "aprovado";
        } elseif ($media >= 5) {
            $situacao = "RECUPERAÇÃO";
            $classeSituacao = "recuperacao";
        } else {
            $situacao = "REPROVADO";
            $classeSituacao = "reprovado";
        }
        ?>

        <div class="resultado">
            <h2>Resultado do Aluno</h2>

            <p><strong>Nome:</strong> <?= htmlspecialchars($nome) ?></p>
            <p><strong>Idade:</strong> <?= $idade ?> anos</p>

            <div class="notas-list">
                <div class="nota-item"><span>Nota 1 (Peso 2):</span> <strong><?= number_format($nota1, 1, ',', '.') ?></strong></div>
                <div class="nota-item"><span>Nota 2 (Peso 3):</span> <strong><?= number_format($nota2, 1, ',', '.') ?></strong></div>
                <div class="nota-item"><span>Nota 3 (Peso 1):</span> <strong><?= number_format($nota3, 1, ',', '.') ?></strong></div>
                <div class="nota-item"><span>Nota 4 (Peso 1):</span> <strong><?= number_format($nota4, 1, ',', '.') ?></strong></div>
                <div class="nota-item"><span>Nota 5 (Peso 3):</span> <strong><?= number_format($nota5, 1, ',', '.') ?></strong></div>
            </div>

            <p><strong>Média Final:</strong> <?= number_format($media, 2, ',', '.') ?></p>
            <p>
                <strong>Situação:</strong>
                <span class="<?= $classeSituacao ?>"><?= $situacao ?></span>
            </p>
        </div>

        <?php
    }
    ?>

    <div class="links">
        <a href="index.php">Calcular médias</a>
        <a href="idade.php">Verificar idade</a>
    </div>

</div>

</body>
</html>