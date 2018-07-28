<?php

//function serializeToArray($data){
//    parse_str($data, $output);
//    return $output;
//}

function toJson($error,$data=[]){
    $error = $error?true:false;
    $data = toArray($data);
    $array = ["error"=>$error,"data"=>$data];
    return json_encode($array);
}

function status($code, $data=[]){
    $data = toArray($data);
    $array = ["code"=>$code,"data"=>$data];
    return $array;
}

function checkError($result){
    $result = json_decode($result,true);
    return $result["error"];
}

function getData($result){
    $result = json_decode($result,true);
    return $result["data"];
}

function checkStatus($result, $not_found="Not Found", $exist="Exist"){
    $status = $result["code"];
    $json = null;
    if($status == OK){
        $json = toJson(0,$result["data"]);
    }elseif ($status == NOT_FOUND){
        $json = toJson(1,$not_found);
    }elseif ($status == EXIST){
        $json = toJson(1,$exist);
    }elseif ($status == ERROR){
        $json = toJson(1,"Error");
    }
    return $json;
}

function toArray($data){
    if(!is_array($data)){
        return (array)$data;
    }
    return $data;
}

?>
