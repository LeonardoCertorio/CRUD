<?php
require_once ("Myconnect.php");

class Colaborador extends Myconnect{
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

    public function listarTodos(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarAtivos(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE status = 1 ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarAna(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE cargo = 'Analista' ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarDev(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE cargo = 'Desenvolvedor' ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarGer(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE cargo = 'Gerente' ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarTest(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE cargo = 'Tester' ORDER BY nome ASC");
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result; 
    }

    public function listarVend(){
        $stmt = $this->conn->prepare("SELECT * FROM Colaboradores WHERE cargo = 'Vendedor' ORDER BY nome ASC");
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
       
        $sql = ("INSERT INTO Colaboradores ($campos1_poo) VALUES ($campos2_poo)");
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data_poo);
        
        if ($stmt->rowCount()) {
           return 1;
        } else {
           return 0;
        }
    }

    public function atualizar($campos, $data){    
        $sql = "update Colaboradores set $campos where id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data);
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }

    public function atualizarStatusParaAtivo($id){   
        $sql = "update Colaboradores set status = 1 where id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        
        if ($stmt->rowCount()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function atualizarStatusParaInativo($id){   
        $sql = "update Colaboradores set status = 0 where id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        
        if ($stmt->rowCount()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function excluir($id){    
        $sql = 'DELETE * FROM Colaboradores where id = :id';
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(array(':id'=>$id));
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }

    public function carregarColaborador($id){
        $sql = "SELECT * FROM Colaboradores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }

    public function carregarNomeColaborador($id){
        $sql = "SELECT nome FROM Colaboradores WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }

    public function carregarColaboradorGerente(){
        $stmt = $this->conn->prepare('SELECT * FROM Colaboradores WHERE cargo = :cargo');
        $stmt->execute(array('cargo' => 'Gerente'));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }
}