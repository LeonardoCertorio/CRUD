<?php
require_once ("Myconnect.php");

class Tarefa extends Myconnect{
    private $campos1, $campos2, $data;
    public $conn;

    public function getCampos1(){
        return $this->campos1;
    }
    public function getCampos2(){
        return $this->campos2;
    }
    public function getdata(){
        return $this->data;
    }

    public function listar(){
        $sql = ("SELECT t.id, t.nome, t.descricao, t.prazo, p.nome as 'projeto', c.nome as 'responsavel' FROM Tarefas as t, Projetos as p, Colaboradores as c WHERE p.responsavel = c.id");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    //acrescentei este método para listar nome das Tarefas nos projetos
    public function listarColabProj(){
        $sql = ("SELECT id, nome, prazo FROM Tarefas ORDER BY prazo ASC");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function cadastrar($campos1, $campos2, $data){
        $this->campos1 = $campos1;
        $this->campos2 = $campos2;
        $this->data = $data;

        $campos1_poo =  $this->getCampos1();
        $campos2_poo =  $this->getCampos2();
        $data_poo =  $this->getdata();
       
        $sql = "INSERT INTO Tarefas ($campos1_poo) VALUES ($campos2_poo)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data_poo);
        
        if ($stmt->rowCount()) {
           return 1;
        } else {
           return 0;
        }
    }
    
    public function atualizar($campos, $data){    
        $sql = ("UPDATE Tarefas set $campos where id = :id");
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data);
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }

    public function deletar($id){    
        $sql = "DELETE FROM Tarefas WHERE tarefas.id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }

    public function carregarTarefas($id){
        $stmt = $this->conn->prepare('SELECT * FROM Tarefas WHERE id = :id');
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }
}