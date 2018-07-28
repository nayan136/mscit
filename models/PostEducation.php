<?php

class PostEducation extends Model
{
    private $table = 'post_education';
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

    public function index($id){
        return parent::select()->where("user_id",$id)->get();
    }

    public function getEducation($postId){
        return parent::select()->where("post_id",$postId)->get();
    }
}