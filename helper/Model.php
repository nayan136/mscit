<?php


class Model
{
    private $conn;
    private $table;
    private $query;

    public function __construct(){
        $this->conn = DB::getInstance()->getConn();
    }

    public function setTable($table){
        $this->table = $table;
    }

    public function tableExists($table) {
        $result = $this->conn->query("SHOW TABLES LIKE '".$table."'");
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insert($values,$columns=null,$uniqueCol=null){
        $duplicate = false;
        $query = "SHOW columns FROM ".$this->table;
        $result = $this->conn->query($query);
        $allCol = [];
        while($row = $result->fetch_array()){
            array_push($allCol,$row['Field']);
        }
        if(is_null($columns)){
            $columns = $allCol;
            array_shift($columns);
        }else{
            $columns = toArray($columns);
        }
        $values = toArray($values);

        if(!is_null($uniqueCol)){
            $duplicate = $this->checkDuplicate($columns,$values,$uniqueCol);
        }
        if(count(array_diff($columns,$allCol))===0){
            if(!$duplicate){
                $col = implode(',',$columns);
                $val="";
                foreach ($values as $v){
                    $val .= "'".$v."',";
                }
                $val = rtrim($val,',');
                $statement = "INSERT INTO ".$this->table." (".$col.") VALUES (".$val.")";
                $result = $this->conn->query($statement);
                if($result){  
                    $last_id = $this->conn->insert_id;
                    //$last_record = $this->select()->where("id",$last_id)->getData();
                    return status(OK,$last_id);
                }else{
                    return status(NOT_FOUND);
                }
            }else{
                return status(EXIST);
            }
        }else{
            echo "Columns Not found: ".implode(',',array_diff($columns, $allCol));
        }

    }

    public function delete($id){
        $statement = "DELETE FROM ".$this->table." WHERE id=".$id;
        if($this->conn->query($statement)){
            return status(OK,$id);
        }else{
            return status(ERROR);
        }
    }

    public function update($col,$val,$id){
        $col = toArray($col);
        $val = toArray($val);
        if(count($col) === count($val)){
            $string="";
            for($i=0;$i<count($col);$i++){
                $string .= $col[$i]."= '".$val[$i]."', ";
            }
            $string = rtrim($string,', ');
            $statement = "UPDATE ".$this->table." SET ".$string." WHERE id=".$id;
            $result = $this->conn->query($statement);
            $count = $this->conn->affected_rows;
            if($result){
                if($count>0){
                    return status(OK,$id);
                }else{
                    return status(EXIST);
                }
            }else{
                return status(ERROR);
            }
        }else{
            echo "coulumn and value mismatched";
        }
    }

//    start method chaining
    public function select($cols='*',$from=null){
        if($from !== null){
            $this->query = "SELECT ".$cols." FROM ".$this->table.",".$from." ";
        }else{
            $this->query = "SELECT ".$cols." FROM ".$this->table." ";
        }

        return $this;
    }

    public function where($col,$val,$oper='='){
        if(strpos($this->query,' WHERE ')){
            $this->query .= "AND ".$col.$oper."'".$val."' ";
        }else{
            $this->query .= "WHERE ".$col.$oper."'".$val."' ";
        }
        return $this;
    }

    public function whereNot($col,$val){
        if(strpos($this->query,' WHERE ')){
            $this->query .= "AND ".$col."<> '".$val."' ";
        }else{
            $this->query .= "WHERE ".$col."<> '".$val."' ";
        }
        return $this;
    }

    public function whereJoin($col,$val,$oper='='){
        if(strpos($this->query,' WHERE ')){
            $this->query .= "AND ".$col.$oper.$val." ";
        }else{
            $this->query .= "WHERE ".$col.$oper.$val." ";
        }
        return $this;
    }

    public function query($statement){
        $this->query .= $statement." ";
        return $this;
    }

    public function orderBy($col,$order='ASC'){
        if(strpos($this->query,' ORDER BY ')){
            $this->query .= ", ".$col." ".$order;
        }else{
            $this->query .= "ORDER BY ".$col." ".$order." ";
        }
        return $this;
    }

    public function join($tableName, $current='id', $foreign='id')
    {
        $this->query .= "JOIN ".$tableName." ON ".$this->table.".".$current."=".$tableName.".".$foreign." ";
        return $this;
    }

    public function get(){
//        echo $this->query;
        $res = $this->conn->query($this->query);
        $result = [];
        if($res){
            if($res->num_rows >0 ){
                while ($row = $res->fetch_assoc()){
                    array_push($result,$row);
                }
                return status(OK,$result);
            }else{
                return status(NOT_FOUND);
            }

        }else{
            return status(ERROR);
        }
    }

    public function count(){
        $res = $this->conn->query($this->query);
        return $res->num_rows;        
    }

    private function getData(){
        $res = $this->conn->query($this->query);
        return (array)$res->fetch_assoc();
    }

    public function toSql(){
        echo $this->query;
    }

    private function checkDuplicate($columns,$values,$uniqueCol){
        $duplicate = false;
        $found = array_search($uniqueCol,$columns);
        if($found !== false){
            $val = $values[$found];
            if($this->select()->where($uniqueCol, $val)->count()){
                $duplicate = true;
            }
        }
        // echo $this->select()->where($uniqueCol, $val)->toSql();
        // var_dump($this->select()->where($uniqueCol, $val)->count());
        // var_dump($duplicate);
        return $duplicate;
//        if(!$duplicate){
//            return true;
//        }else{
//            return false;
//        }
    }
}