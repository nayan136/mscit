<?php


class User extends Model
{
    private $table = 'user';
    private $uniqueCol = 'email';
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

    public function register( $values)
    {
       $status = parent::insert($values,null,$this->uniqueCol);
       if(!empty($status["data"])){
           $id = $status["data"][0];
           $result = parent::select()
               ->where("id",$id)
               ->get();
           return $result;
       }
    }

    public function login($email, $password)
    {
        $result = parent::select()->where("email",$email)
            ->where("password",$password)
            ->where("user_active",1)
            ->whereNot("user_role","admin")
            ->get();
        return $result;
    }

    public function adminLogin($email, $password){
        $result = parent::select()->where("email",$email)
            ->where("password",$password)
            ->where("user_role","admin")
            ->get();
        return $result;
    }

    public function update($col,$val,$id){
        $status = parent::update($col,$val,$id);
        if(!empty($status["data"])){
            $id = $status["data"][0];
            $result = parent::select()
                ->where("id",$id)
                ->get();
            return $result;
        }
    }

    public function applicantList($postId){
        return parent::select("user.*","apply_post")
            ->whereJoin("user.id","apply_post.user_id")
            ->whereJoin("apply_post.post_id",$postId)
            ->get();
    }

    public function getUser($userId){
        return parent::select()->where("id",$userId)->get();
    }

    public function getCandidate(){
        return parent::select()
            ->where("user_role",CANDIDATE)
            ->get();
    }

    public function getActiveRecruiter(){
        return parent::select()
            ->where("user_role",RECRUITER)
            ->where("user_active",1)
            ->get();
    }

    public function getPendingList(){
        return parent::select()
            ->where("user_role",RECRUITER)
            ->where("user_active",0)
            ->get();
    }
    public function approveRecruiter($id){
        $result = parent::update("user_active",1,$id);
        if(!empty($result["data"])){
            $id = $result["data"][0];
            $result = parent::select("user_name")
                ->where("id",$id)
                ->get();
            return $result;
        }
        return $result;
    }
}