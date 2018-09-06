<?php


class Company extends Model
{
    private $table = 'company';

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

    public function companyByUser($userId){
        $userCompany = new UserCompany();
//        echo checkStatus($userCompany->getCompany($userId));
        $data = checkStatus($userCompany->getCompany($userId));
        if(!checkError($data)){
            $companyId = getData($data)[0]["company_id"];
//            echo $companyId;
            return parent::select()->where("id",$companyId)->get();
        }
        return $data;
    }

    public function companyName($companyId){
        return parent::select()->where("id",$companyId)->get();
    }

}