<?php

class Post extends Model
{
    private $table = 'post';
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

    public function myPosts($userId){
        return parent::select()->where('user_id',$userId)->get();
    }

    public function recommendedPost($userId){
               return parent::select("post.*","candidate_education ,post_education")
            ->whereJoin("post.id","post_education.post_id")
            ->whereJoin("post.user_id","candidate_education.user_id")
            ->whereJoin("candidate_education.percentage","post_education.min_percentage",">=")
            ->whereJoin("candidate_education.education_name","post_education.education_name")
            ->whereJoin("post.user_id",$userId)
            ->whereJoin("post.created_at",Date::today(),">=")
            ->query("AND (post.id NOT IN (SELECT post_id FROM apply_post) OR post.user_id NOT IN (SELECT user_id FROM apply_post))")
            ->get();
    }
}