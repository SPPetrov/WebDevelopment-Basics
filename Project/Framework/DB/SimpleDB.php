<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 11:12 PM
 */

namespace FW\DB;

class SimpleDB
{
    protected $connection = 'default';
    private $db = null;
    private $statement = null;
    private $params = array();
    private $sql;
    public function __construct($connection=null)
    {
        if($connection instanceof \PDO){
            $this->db=$connection;
        }else if($connection != null){
            $this->db = \FW\App::getInstance()->getDBConnection($connection);
            $this->connection = $connection;
        }else{
            $this->db=\FW\App::getInstance()->getDBConnection($this->connection);
        }
    }

    /**
     * @param $sql
     * @param array $params
     * @param array $pdoOptions
     * @return \FW\DB\SimpleDB
     */
    public function prepare($sql, $params=array(), $pdoOptions=array()){
        $this->statement = $this->db->prepare($sql, $pdoOptions);
        $this->params = $params;
        $this->sql = $sql;
        return $this;
    }

    /**
     * @param array $params
     * @return \FW\DB\SimpleDB
     */
    public function execute($params = array()){
        if($params){
            $this->params = $params;
        }

        $this->statement->execute($this->params);
        return $this;
    }

    public function fetchAllAssoc(){
        return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc(){
        return $this->statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function getLastInsertId(){
        return $this->db->lastInsertId();
    }

    public function getAffectedRows(){
        return $this->statement->rowCount();
    }

    public function getStatement(){
        return $this->statement;
    }
}