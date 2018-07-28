<?php

class Education extends Model
{
    private $table = 'education';
    private $uniqueCol = 'edu_name';
    public function __construct()
    {
        parent::__construct();
        if(!$this->tableExists($this->table)){
            $this->createTable();
        }
        $this->setTable($this->table);
    }

    private function createTable(){
        echo "Table is creating";
    }

    public function geteducation($educationId){
        return parent::select()->where("id",$educationId)->get();
    }

    public function store($data){
        return parent::insert($data,null,$this->uniqueCol);
    }
    public function index(){
       return parent::select()->get();
    }
    public function update($col,$val,$id){
        return parent::update($col,$val,$id);
    }
    public function delete($id)    {
        return parent::delete($id);
    }
}