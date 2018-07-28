<?php

class ApplyPost extends Model
{
    private $table = 'apply_post';
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

    public function apply($data){
        return parent::insert($data);
    }

    public function applyList($userId){
        return parent::select("post.*","post")
            ->whereJoin("apply_post.post_id","post.id")
            ->whereJoin("apply_post.user_id",$userId)
            ->get();
    }

    public function applicantCount($postId){
        return parent::select("COUNT(id) AS count")->where("post_id",$postId)->get();
    }
}