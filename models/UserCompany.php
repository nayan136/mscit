<?php


class UserCompany extends Model
{
    private $table = 'user_company';

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

    public function store($data){
        return parent::insert($data);
    }

    public function getCompany($userId){
        return parent::select("company_id")->where("user_id",$userId)->get();
    }
}