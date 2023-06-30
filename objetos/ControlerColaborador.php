<?php
include_once("./Model/Colaborador.php");
$colaborador = new Colaborador();

if(isset($_POST["nome"]) && isset($_POST["cpf"]) && isset($_POST["cargo"]) && 
isset($_POST["acao"])){
    
    if(!empty($_POST["nome"]) && !empty($_POST["cpf"]) && !empty($_POST["cargo"]) && 
    !empty($_POST["acao"])){
      
        $nome = $_POST["nome"];
        $cargo = $_POST["cargo"];
        $cpf = $_POST["cpf"];
        $acao = $_POST["acao"];
        
        if($acao=="inserir"){
            $campos1 = "nome, cargo, cpf";
            $campos2 = ":nome, :cargo, :cpf";
            $tabela = "projetos";
            
            $dados = array('nome'=>$nome, 'cargo'=>$cargo, 'cpf'=>$cpf);
            $result = $colaborador->cadastrar($campos1, $campos2, $dados);       
    
            if($result){    
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");    
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            }

        }elseif($acao=="editar"){
            if(isset($_POST["id"]) && isset($_POST["status"]) && !empty($_POST["id"]) && !empty($_POST["status"])){
                $id = $_POST["id"];

                echo $nome;
                echo $cpf;
                echo $cargo;
                echo $status;
                echo $id;
                $campos = "nome = :nome, cpf = :cpf, cargo = :cargo, status = :status";
                $dados = array('nome'=>$nome, 'cpf'=>$cpf, 'cargo'=>$cargo, 'status'=>$status, 'id'=>$id);
                $result = $colaborador->atualizar($campos, $dados);       
                
                var_dump($campos);
                var_dump($dados);
                var_dump($colaborador);
                var_dump($result);

                if($result){
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
                }else{
                    header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
                }    
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            }
            
        }else{
            echo "Em construção";
        }
        
    }else{
        header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
    }
}else{
    if(isset($_GET["acao"]) && isset($_GET["id"]) && !empty($_GET["acao"]) && !empty($_GET["id"])){
        $acao = $_GET["acao"];
        $id = $_GET["id"];

        if($acao == "excluir"){
            $result = $colaborador->excluir($id);   
            
            $campos = "ativo = :ativo";
            $dados = array('ativo'=>1, 'id'=>$id);
            $result = $colaborador->atualizar($campos, $dados);     

            if($result){
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=sucesso");
            }else{
                header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
            }
        }
    }else{
        header("Location: ./index.php?pagina=colaborador.php&acao=listar&mensagem=erro");
    }
}
?>