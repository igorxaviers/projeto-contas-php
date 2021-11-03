<?php 
    include_once("./Aluno.php");
    include_once("./Conexao.php");
    $nome = "Igor";
    echo "Olá, {$nome}";
    echo $nome;
    $nomes = ["Igor", "João", "Maria"]; 
    $alunos = [
        0 => [
            "nome" => "Igor",
            "idade" => "23",
            "cidade" => "São Paulo"
        ],
        1 => [
            "nome" => "João",
            "idade" => "25",
            "cidade" => "São Paulo"
        ],
        2 => [
            "nome" => "Maria",
            "idade" => "20",
            "cidade" => "São Pauloo"
        ]
    ];

    $aluno = new Aluno("Igor", "23", "São Paulo");
    $con = Conexao::getConexao();

    /* Prepare an insert statement */
    $sql = $con->prepare("INSERT INTO alunos (alu_nome, alu_email) VALUES (?,?)");
    /* Bind variables to parameters */
    $nome = "Igor";
    $dataNasc = new DateTime();
    $email = "xaves@gmail.com";
    $sql->bind_param("ss", $nome, $email);
    /* Execute the statement */
    $sql->execute();
    /* Close statement */
    $sql->close();

    $sql = "SELECT * FROM alunos";
    $result = $con->query($sql);

    var_dump($result);    



    function imprimirNomes($nomes = []){
        foreach($nomes as $nome){
            echo $nome . "<br>";
        }
    }
    
    function soma($a, $b){
        return $a + $b;
    }

    function fatorial($n){
        if($n == 1)
            return 1;

        return $n * fatorial($n - 1);
    }



?>
<p><?= 5*3?></p>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        foreach($result as $row) {
            echo("<p>Nome: {$row["alu_nome"]} - - Email: {$row["alu_email"]}</p>");
        }

    ?>
    <!-- <?php for($i = 0; $i < 10; $i++) { ?>
            <p><?= $i ?></p>
    <?php } ?>

    <?php foreach($nomes as $key => $nome) { ?>
        <p><?= $key ." - ".$nome?></p>
    <?php } ?>

    <?php foreach($nomes as $nome) { ?>
        <p><?= $nome ?></p>
    <?php } ?>

    <?php foreach($alunos as $aluno) { ?>
        <p><?= "{$aluno["nome"]} - {$aluno["idade"]} - {$aluno["cidade"]}" ?></p>
    <?php } ?>

    <?php imprimirNomes($nomes) ?>
    <?= soma(10,20) ?> -->

</body>
</html>