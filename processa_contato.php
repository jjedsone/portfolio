<?php
// Configurações do banco de dados
$host = 'localhost'; // ou seu host do banco de dados
$dbname = 'meu_site'; // Nome do seu banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Coleta os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $assunto = $_POST['assunto'];
        $mensagem = $_POST['mensagem'];

        // Prepara a consulta para inserir os dados no banco de dados
        $sql = "INSERT INTO contatos (nome, email, mobile, assunto, mensagem) 
                VALUES (:nome, :email, :mobile, :assunto, :mensagem)";
        $stmt = $pdo->prepare($sql);

        // Vincula os parâmetros com os valores recebidos do formulário
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':assunto', $assunto);
        $stmt->bindParam(':mensagem', $mensagem);

        // Executa a consulta
        if ($stmt->execute()) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar mensagem.";
        }
    }
} catch (PDOException $e) {
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>
