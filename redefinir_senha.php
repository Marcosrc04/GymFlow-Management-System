
<?php
session_start();
include("includes/conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $senha = $_POST["senha"] ?? "";

    if (strlen($senha) < 8) {
        $mensagem = "A senha precisa ter pelo menos 8 caracteres.";
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $id = 2;
        $tipo = "admin";

        $stmt = $conexao->prepare(
            "UPDATE usuarios SET senha = ? WHERE id = ? AND tipo = ?"
        );

        $stmt->bind_param("sis", $hash, $id, $tipo);

        if ($stmt->execute() && $stmt->affected_rows === 1) {
            $mensagem = "Senha alterada! Faça login com a nova senha.";
        } else {
            $mensagem = "Não foi possível alterar. Confira o ID e o tipo do usuário.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir senha</title>
</head>
<body>
    <h2>Redefinir senha do aluno</h2>

    <form method="POST">
        <label>Digite sua nova senha (mínimo 8 caracteres):</label><br>
        <input type="password" name="senha" minlength="8" required>
        <button type="submit">Alterar senha</button>
    </form>

    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
</body>
</html> <div class=""> </div>
huihiuh
