<?php
require_once ("Myconnect.php");

class Projetos extends Myconnect{
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
        $sql = ('SELECT p.id, p.nome as '."projeto".', p.descricao, p.dataInicio, c.nome FROM projetos as p, colaboradores as c WHERE p.responsavel = c.id ORDER BY p.dataInicio ASC');
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);      
        return $result; 
    }

    function listarProjetosAbertos($status){
        $sql = ('SELECT p.id, p.nome as '."projeto".', p.descricao, p.dataInicio, c.nome FROM projetos as p, colaboradores as c WHERE p.status = :status AND p.responsavel = c.id ORDER BY p.dataInicio ASC');
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':status' => $status));
    
        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }

    public function listarColabGerente(){
        $sql = ("SELECT id, nome FROM colaboradores WHERE cargo = :cargo");
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':cargo' => 'Gerente'));
        
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

        $sql = "INSERT INTO projetos ($campos1_poo) VALUES ($campos2_poo)";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data_poo);
        
        if ($stmt->rowCount()) {
           return 1;
        } else {
           return 0;
        }
    }
    
    public function atualizar($campos, $data){    
        $sql = "UPDATE projetos SET $campos WHERE id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute($data);
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }
    
    public function desligar($id){    
        $sql = "UPDATE colaboradores SET status = 0 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':id' => $id));
        
        if ($stmt->rowCount()) {
            return 1;
         } else {
            return 0;
         }
    }

    public function carregarProjeto($id){
        $sql = "SELECT * FROM projetos WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array('id' => $id));

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }

    public function vizualizarProjeto($id){
        $sql = "SELECT p.id, p.nome as 'projeto', 
        p.descricao, c.nome as 'responsavel', 
        p.status, p.dataInicio, p.dataTermino FROM 
        projetos as p, colaboradores as c WHERE 
        p.responsavel = c.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO :: FETCH_ASSOC);
        return $result;
    }
}