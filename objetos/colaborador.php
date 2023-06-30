<?php
include("./Model/Colaborador.php");
$colab1 = new Colaborador();
?>

<div>
<h2>Gestão de Colaboradores</h2>
<a href="index.php?pagina=colaborador.php&acao=listarTodos"><button class="button button1">Listar Todos</button></a>
<a href="index.php?pagina=colaborador.php&acao=listarAtivos"><button class="button button1">Listar Colaboradores Ativos</button></a>
<a href="index.php?pagina=colaborador.php&acao=inserir"><button class="button button2">Adicionar Colaborador</button></a>
<br></br>
<a href="index.php?pagina=colaborador.php&acao=listarAna"><button class="button button3">Listar Analistas</button></a>
<a href="index.php?pagina=colaborador.php&acao=listarDev"><button class="button button3">Listar Desenvolvedores</button></a>
<a href="index.php?pagina=colaborador.php&acao=listarGer"><button class="button button3">Listar Gerentes</button></a>
<a href="index.php?pagina=colaborador.php&acao=listarTest"><button class="button button3">Listar Testers</button></a>
<a href="index.php?pagina=colaborador.php&acao=listarVend"><button class="button button3">Listar Vendedores</button></a>
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
        Ocorreu um erro na operação com o colaborador, reveja os dados e tente novamente mais tarde. Obrigado!
        </div>
<?php
    }
}

if(isset($_GET["acao"]) && !empty($_GET["acao"])){
    $acao = $_GET["acao"];

    if($acao=="listarTodos"){
        $resultado = $colab1->listarTodos();
        if (count($resultado)) {
?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>CARGO</th>
                    <th>STATUS</th>
                    <th>AÇÃO</th>
                </tr>
<?php  
            foreach($resultado as $row) {
                $id = $row["id"];
?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?=$row["nome"]?></td>
                    <td><?=$row["cargo"]?></td>
                    <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                    </td>                    
                    <td>
                    <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                    <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                    <a href="index.php?pagina=controlerColaborador.php&acao=excluir&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                    </td>
                </tr>        
<?php } ?>
            </table>
<?php
        } else {
            echo "Nenhum resultado retornado.";
        }
    } elseif($acao=="listarAtivos"){
        $resultado = $colab1->listarAtivos();
        if (count($resultado)) {
?>
            <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>CARGO</th>
                    <th>STATUS</th>
                    <th>AÇÃO</th>
                </tr>
<?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }

    } elseif($acao=="listarAna"){
        $resultado = $colab1->listarAna();
        if (count($resultado)) {
        ?>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
        <?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                    
                    if ($row["status"] == 1) {
                        echo "Ativo";
                    } else {
                        echo "Inativo";
                    }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }    
            
    } elseif($acao=="listarDev"){
        $resultado = $colab1->listarDev();
        if (count($resultado)) {
        ?>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
        <?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }

    } elseif($acao=="listarGer"){
        $resultado = $colab1->listarGer();
        if (count($resultado)) {
        ?>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
        <?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }
        
    } elseif($acao=="listarTest"){
        $resultado = $colab1->listarTest();
        if (count($resultado)) {
        ?>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
        <?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }

    } elseif($acao=="listarVend"){
        $resultado = $colab1->listarVend();
        if (count($resultado)) {
        ?>
        <table id="customers">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>STATUS</th>
                <th>AÇÃO</th>
            </tr>
        <?php  
            foreach($resultado as $row) {
                $id = $row["id"];
            ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?=$row["nome"]?></td>
                <td><?=$row["cargo"]?></td>
                <td><?php                   
                        if ($row["status"] == 1) {
                            echo "Ativo";
                        } else {
                            echo "Inativo";
                        }?>
                </td>                    
                <td>
                <a href="index.php?pagina=colaborador.php&acao=visualizar&id=<?=$id?>"><button class="button button4">Visualizar</button></a>
                <a href="index.php?pagina=colaborador.php&acao=alterar&id=<?=$id?>"><button class="button button2">Alterar</button></a>
                <a href="index.php?pagina=controlerColaborador.php&acao=desligar&id=<?=$id?>"><button class="button button3">Excluir</button></a>
                </td>
            </tr>        
            <?php } ?>
        </table>
            <?php
            } else {
                echo "Nenhum resultado retornado.";
            }

    }elseif($acao=="inserir"){ ?>

    <h2>Adicionar novo Colaborador</h2>

    <div class="boxForm">
    <form action="controlerColaborador.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Informe o seu nome">

        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" placeholder="Informe o seu CPF sem pontos e traços.">

        <label for="cargo">Cargo</label>
        <select id="cargo" name="cargo">
        <option value="Analista">Analista</option>
        <option value="Desenvolvedor">Desenvolvedor</option>
        <option value="Gerente">Gerente</option>
        <option value="Tester">Tester</option>
        <option value="Vendedor">Vendedor</option>
        </select>

        <input type="hidden" name="acao" value="inserir">
        <input type="submit" value="Adicionar">
    </form>
    </div>

    <?php
    }elseif($acao=="alterar"){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $row = $colab1->carregarColaborador($id);
            foreach($row as $dado)
            ?>

            <h2>Alterar Colaborador</h2>

            <div class="boxForm">
            <form action="controlerColaborador.php" method="post">

                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?=$dado['nome'];?>">

                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="<?=$dado['cpf'];?>">

                <label for="cargo">Cargo</label>
                <select id="cargo" name="cargo">

                <option value="Gerente" <?php if($dado['cargo'] == "Gerente") echo "selected"?>>Gerente</option>
                <option value="Desenvolvedor" <?php if($dado['cargo'] == "Desenvolvedor") echo "selected"?>>Desenvolvedor</option>

                </select>

                <?php ?>

                <label for="status">Status: </label>

                <?php if($dado["status"]==0){ echo "Inativo<br>";?><input type="button" class="button3" onclick=atualizarStatusParaAtivo() value="Ativar"></input>
            
                <?php } if($dado["status"]==1){ echo "Ativo<br>";?><input type="button" class="button1" onclick=atualizarStatusParaInativo() value="Desativar"></input><?php } ?>

                    <input type="hidden" name = "id" value ="<?=$id?>">
                    <input type="hidden" name = "acao" value ="editar">
                    <input type="submit" value="Atualizar">
            </form>
            </div>
        <?php
        
        }else{
            header("Location: ./index.php?pagina=colaborador.php&acao=listarTodos&mensagem=erro");
        }      
    }elseif($acao=="excluir"){ ?>

        <h2>Adicionar novo Colaborador</h2>
    
        <div class="boxForm">
        <form action="controlerColaborador.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Informe o seu nome">
    
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="Informe o seu CPF sem pontos e traços.">
    
            <label for="cargo">Cargo</label>
            <select id="cargo" name="cargo">
            <option value="Analista">Analista</option>
            <option value="Desenvolvedor">Desenvolvedor</option>
            <option value="Gerente">Gerente</option>
            <option value="Tester">Tester</option>
            <option value="Vendedor">Vendedor</option>
            </select>
    
            <input type="hidden" name="acao" value="inserir">
            <input type="submit" value="Adicionar">
        </form>
        </div>
    
        <?php
        
    
    }elseif($acao=="visualizar"){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
            $id = $_GET["id"];
            $row = $colab1->carregarColaborador($id);
            foreach($row as $dado){
                echo "Identificador: " . $dado["id"];
                echo "<br>Nome: " . $dado["nome"];
                echo "<br>CPF: " . $dado["cpf"];
                echo "<br>Cargo: " . $dado["cargo"];
                if($dado["status"]==0){
                    echo "<br>Status: Inativo";
                }else{
                    echo "<br>Status: Ativo";
                }
            }
        }
    }
    }
?>