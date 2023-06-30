<?php
    include("functions.php");
    $conn = conectar();
    
    //inserção de registro
    //Projetos
    $campos1 = "nome, descricao, responsavel, status, dataInicio, dataTermino";
    $campos2 = ":nome, :descricao, :responsavel, :status, :dataInicio, :dataTermino";
    $tabela = "projetos";
    cadastro($conn, $tabela, $campos1, $campos2, $dados);

    //Colaboradores
    $campos1 = "nome, cpf, cargo, status";
    $campos2 = ":nome, :cpf, :cargo, :status";      
    $tabela = "colaboradores";
    cadastro($conn, $tabela, $campos1, $campos2, $dados);

    //Alteração de registro
    //Projetos
    $tabela = "projetos";
    $campos = "nome = :nome, descricao = :descricao, responsavel = :responsavel, status = :status, dataInicio = :dataInicio, dataTermino = :dataTermino";
    atualizar($conn, $tabela, $campos, $dados);
    
    //Colaboradores
    $tabela = "colaboradores";
    $campos = "nome = :nome, cpf = :cpf, cargo = :cargo, status = :status";
    atualizar($conn, $tabela, $campos, $dados);

    //Deletar  registro
    //Projetos
    $id = 1;
    $tabela = "colaboradores";
    deletar($conn, $tabela, $id);

    
    /*listagem de registro*/
    echo "<br><b>Relatório Geral de colaboradores</b><br>";
    listarColaboradores($conn);
    
    echo "<br><b>Relatório com Colaborador especifico com o ID</b><br>";
    $id = 2;
    listarWhere($conn,$id);

    echo "<br><b>Relatório Geral de colaboradores de cargo Gerente ordenado em ordem crescente</b><br>";
    $cargo = "Gerente";
    listarGerente($conn,$cargo);

    echo "<br><b>Relatório Geral de Projetos</b><br>";
    listarProjetos($conn);

    echo "<br><b>Relatório Geral de Projetos com status Ativo ou Inativo</b><br>";
    $status = 1;
    listarProjetosStatus($conn,$status);
    ?>
    <head>
        <?php
            

?>