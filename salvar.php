<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Status do Salvamento</title>
    <link rel="stylesheet" href="salvar.css">
</head>
<body>

<?php
// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Coleta e limpa os dados do formulário
    $nome = trim(htmlspecialchars($_POST["nome"]));
    $github = trim(htmlspecialchars($_POST["github"]));
    $turma = trim(htmlspecialchars($_POST["turma"]));
    $disciplina = trim(htmlspecialchars($_POST["disciplina"]));
    
    // 2. Valida se os campos não estão vazios
    if (!empty($nome) && !empty($github) && !empty($turma) && !empty($disciplina)) {
        
        // 3. Monta a string que será salva no arquivo
        $data = "----------------------------------------\n";
        $data .= "Data de Cadastro: " . date("d/m/Y H:i:s") . "\n";
        $data .= "Nome: " . $nome . "\n";
        $data .= "GitHub: " . $github . "\n";
        $data .= "Turma: " . $turma . "\n";
        $data .= "Disciplina: " . $disciplina . "\n\n";
        
        // 4. Define o nome do arquivo
        $arquivo = "dados.txt";
        
        // 5. Salva a string no arquivo
        // FILE_APPEND: Adiciona o conteúdo ao final do arquivo, em vez de sobrescrevê-lo.
        // LOCK_EX: Previne que outros usuários escrevam no arquivo ao mesmo tempo.
        if (file_put_contents($arquivo, $data, FILE_APPEND | LOCK_EX)) {
            echo '<div class="message success"><h1>Sucesso!</h1><p>Seus dados foram salvos com sucesso.</p>';
        } else {
            echo '<div class="message error"><h1>Erro!</h1><p>Não foi possível salvar os dados no arquivo.</p>';
        }
        
    } else {
        echo '<div class="message error"><h1>Erro!</h1><p>Todos os campos são obrigatórios.</p>';
    }
} else {
    // Se alguém tentar acessar salvar.php diretamente
    echo '<div class="message error"><h1>Acesso Inválido</h1><p>Por favor, preencha o formulário primeiro.</p>';
}
?>
    <a href="index.html">Voltar ao Formulário</a>
</div>

</body>
</html>