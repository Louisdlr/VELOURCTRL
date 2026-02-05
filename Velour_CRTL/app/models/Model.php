<?php
namespace App\Models;
use Database\DBConnection;
use PDO;
abstract class Model {

    protected $db;
    protected $table;

    public function __construct( $db)
    {
        $this->db = $db;
    }

    public function all():array
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    public function findById(int $id)
    {
        return $this->query("select * from {$this->table} where id = ?",[$id],true);
    }

    public function findByColumn($value, string $nameColumn)
    {
        return $this->query("select * from {$this->table} where {$nameColumn} = ?",[$value],true);
    }

    public function countByValue($value, string $nameColumn)
    {
        return $this->query("select count(id) as nb from {$this->table} where {$nameColumn} = ?",[$value],true);
    }

    public function query(string $sql, array $param = null,bool $single=null)
    {
        $method = is_null($param) ? "query" : "prepare";
        if(
            strpos($sql,'DELETE')=== 0 ||
            strpos($sql,'UPDATE')=== 0 ||
            strpos($sql,'INSERT')=== 0 
        ){
            $stmt = $this->db->getPDO()->$method($sql);
            $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);
            return $stmt->execute($param);
        }

        $fetch =  is_null($single) ? 'fetchAll' : 'fetch';
        $stmt = $this->db->getPDO()->$method($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS,get_class($this),[$this->db]);

        if($method === 'query')
        {
            return $stmt->$fetch();  
        } else {
            $stmt->execute($param);
            return $stmt->$fetch(); 
        }
    }

    public function create(array $data,?array $relations = null)
    {
        $firstpart ="";
        $secondpart = "";
        $i = 1; 
        foreach($data as $key => $value)
        {
            $separator = $i === count($data) ? "" :",";
            $firstpart .=" {$key}{$separator}";
            $secondpart .= ":{$key}{$separator}";
            $i++;
        }
       
        return $this->query("INSERT INTO {$this->table} ({$firstpart})
        VALUES ({$secondpart})",$data);
        
    }

    public function update(int $id,array $data,array $relations = null){
        
        $sqlRequestPart ="";
        $i = 1;
        foreach($data as $key=>$value)
        {
            $separator = $i == count($data) ? " " :",";
            $sqlRequestPart .= "{$key}= :{$key}{$separator}";
            $i ++;
        }
        $data['id'] = $id;
        
        return $this->query("UPDATE {$this->table} SET {$sqlRequestPart} WHERE id=:id",$data);
    }

    public function destroy(int $id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function recupLastId()
    {
        return $this->db->getPDO()->lastInsertId();
    }
}