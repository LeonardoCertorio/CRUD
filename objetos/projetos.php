<?php

require_once("./Model/Projetos.php");
require_once("./Model/Colaborador.php");

$projeto = new Projetos();
$colaborador = new Colaborador();

?>
<div>
<h2>Gestão de Projetos</h2>
<a href="index.php?pagina=projetos.php&acao=listar"><button class="button button1">Projetos em Aberto</button></a>
<a href="index.php?pagina=projetos.php&acao=inserir"><button class="button button2">Adicionar Projeto</button></a>

</div>
<?php
if(isset($_GET["mensagem"]) && !empty($_GET["mensagem"])){
    $mensagem = $_GET["mensagem"];

    if($mensagem=="sucesso"){
    ?>
        <div class="alert success">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Operação realizada com sucesso!!!.
        </div>
    <?php
    }else{
        ?>
        <div class="alert warning">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Ocorreu um erro na operação com o projeto, reveja os dados e tente novamente mais tarde. Obrigado!
        </div>
        <?php
    }
}

if(isset($_GET["acao"]) && !empty($_GET["acao"])){
    $acao = $_GET["acao"];

    if($acao=="listar"){
        $status = 1;
        $resultado = $projeto->listarProjetosAbertos(1);

        if (count($resultado)) {
        ?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>PROJETO</th>
                    <th>GERENTE</th>
                    <th>INICIO</th>
                    <th>AÇÃO</th>
                </tr>
            <?php  
                $i=1;
                foreach($resultado as $row) {
                    $id = $row["id"];
                    
                    $resultadoColaborador = $colaborador->carregarColaborador($row["id"]);
                    foreach($resultadoColaborador as $rowColaborador)
                ?>
                <tr>
                    <td><?php echo $row["id"] ?></td>
                    <td><?=$row["projeto"]?></td>
                    <td><?=$row["nome"]?></td>
                    <td><?php
                        $data = new DateTime($row["dataInicio"]);
                        echo $data->format('d/m/Y');
                    ?></td>
                    <td>
                    <a href="index.php?pagina=projetos.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                    <a href="index.php?pagina=projetos.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                    <a href="index.php?pagina=controlerprojetos.php&acao=excluir&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>

                </tr>        
                <?php  
                }
                ?>
            </table>
                <?php
            } else {
                echo "Nenhum resultado retornado.";
            }
    }elseif($acao=="inserir"){
    ?>
    <h2>Adicionar novo Projeto</h2>

    <div class="boxForm">
    <form action="controlerProjetos.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Informe o seu nome">

        <label for="descrição">Descrição</label>
        <textarea id="descricao" name="descricao" placeholder="Informe o seu descrição sem pontos e traços."></textarea>

        <label for="cargo">Gerente Responsável</label>
        <select id="cargo" name="cargo">
        <?php
            $colaboradorGerente = $colaborador->carregarColaboradorGerente();
            foreach($colaboradorGerente as $rowColaborador){
            ?>
                <option value=<?=$rowColaborador['id']?>><?=$rowColaborador['nome']?></option>
            <?php } ?>
        </select>
        <label for="dataInicio">Data de Início</label>
        <input type="date" id="dataInicio" name="dataInicio">

        <input type="hidden" name="acao" value="inserir">
        <input type="hidden" name="status" value="1">
        <input type="submit" value="Adicionar">
    </form>
    </div>

    <?php
    }elseif($acao=="alterar"){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $row = $projeto->carregarProjeto($id);
            foreach($row as $dado)
        ?>
            <h2>Alterar Projeto</h2>

            <div class="boxForm">
            <form action="controlerProjetos.php" method="post">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?=$dado['nome'];?>">

                <label for="descricao">Descrição</label>
                <input type="text" id="descricao" name="descricao" value="<?=$dado['descricao'];?>">

                <label for="cargo">Gerente Responsável</label>
                <select id="cargo" name="cargo">
                <?php
                    $colaboradorGerente = $colaborador->carregarColaboradorGerente();
                    foreach($colaboradorGerente as $rowColaborador){
                    ?>
                        <option value=<?=$rowColaborador['id']?>>
                        <?=$rowColaborador['nome']?></option>
                    <?php
                    }
                ?>
                </select>
                <input type="hidden" name = "id" value ="<?=$id?>">
                <input type="submit" name = "acao" value ="editar">
                <input type="button" onclick=update() value="Projeto finalizado!">
                <input type="submit" value="Atualizar">
            </form>
            </div>
    <?php
        }else{
            header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
        }
    }elseif($acao=="visualizar"){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $resultado = $projeto->vizualizarProjeto($id);
?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>
                    <th>RESPONSÁVEL</th>
                    <th>STATUS</th>
                    <th>DATA DE INÍCIO</th>
                    <th>DATA DE TÉRMINO</th>
                    <th>AÇÕES</th>
                </tr>
<?php  
            foreach($resultado as $data) {
                $id = $data["id"];
?>
            <tr>
                <td><?php echo $data["id"] ?></td>                
                <td><?=$data["projeto"]?></td>
                <td><?=$data["descricao"]?></td>
                <td><?=$data["responsavel"] ?></td>
<?php
                if ($data["status"]==1) {
                    ?><td>Em andamento</td>
<?php                    
                } elseif ($data["status"]==2) {
                    ?><td>Cancelado</td>
<?php                    
                } elseif ($data["status"]==0) {
                    ?><td>Finalizado</td>
<?php                    
                }
?> <td> <?php
                    $date = new DateTime($data["dataInicio"]);
                    echo $date->format('d/m/Y');
?>              </td>
                <td> 
<?php
                    if ($data["dataTermino"]==null){
                        echo "Inacabado";
                    } else{
                    $date = new DateTime($data["dataTermino"]);
                    echo $date->format('d/m/Y');
                    }
?>              </td>
                <td>
                    <a href="index.php?pagina=projetos.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                    <br></br>
                    <a href="index.php?pagina=controlerprojetos.php&acao=excluir&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>

            </tr>        
            <?php  
            }
        }
    }   
}
?> </table>