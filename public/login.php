<!<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--  css  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <title>Document</title>
</head>
<body>

<?php
    require_once '../core/init.php';
    define("FORM_EMAIL","form_email");

    if(Session::has(USER_EMAIL)){
        header("Location: admin/index.php");
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST["email"]) && !empty($_POST["password"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            Session::add(FORM_EMAIL,$email);
            $user = new User();
            $result = checkStatus($user->adminLogin($email, $password));
//            echo $result;
            if(!checkError($result)){
                $array = getData($result)[0];
                Session::add(USER_ID,$array["id"]);
                Session::add(USER_EMAIL,$array["email"]);
                Session::add(USER_NAME,$array["user_name"]);
                header("Location: admin/index.php");
                die();
            }else{
                $error = "Email or Password wrong";
            }
        }else{
            $error = "Form is not completely filled";
        }
    }
?>
    <div class="h-100 d-flex justify-content-center item-center">
        <div class="w-20 card">
            <h2 class="text-center">Login</h2>
            <form method="post" action="login.php">
                <span>Email</span>
                <input type="text" name="email" value="<?php echo Session::has(FORM_EMAIL)?Session::flushGet(FORM_EMAIL):null?>"/>
                <span>Password</span>
                <input type="text" name="password"/>
                <div class="text-center">
                    <input class="btn primary" type="submit" value="Login" />
                </div>
            </form>
            <div>
                <span class="label-error"><?php echo isset($error)?$error:null; ?></span>
            </div>
        </div>
    </div>
</body>
</html>