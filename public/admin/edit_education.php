<?php require_once "include/header.php" ?>
<?php require_once "include/sidebar.php" ?>

<?php
    $error = false;
    $errorForm = false;
    $update = false;
    $education = new Education();
    // get
    if(isset($_GET["edu_id"]) && !empty($_GET["edu_id"])){
        $education_id = $_GET["edu_id"];
        Session::remove('edu_id');
        Session::add('edu_id',$education_id);
        // get education details
        $result = checkStatus($education->geteducation($education_id));
        if(!checkError($result)){
            $oldEduName = getData($result)[0]["edu_name"];
            $oldDepartment = getData($result)[0]["department"];
        }else{
            die("Something went wrong");
        }
        $update = true;
        $header = "Update Education";
    }else{
        $header = "Add Education";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eduName = $_POST["edu_name"];
        $department = $_POST["department"];
        if(!empty($eduName)){
            //  create
            if(isset($_POST["create"])){
                $data = [$eduName,$department];
                $result = checkStatus($education->store($data));
                if(!checkError($result)){
                    $error = false;
                    $message = $eduName." added successfully";
                }else{
                    $error = true;
                    $message = $eduName." cannot be added";
                }
            }
            //  update
            if(isset($_POST["update"])){
                $col = ['edu_name','department'];
                $val = [$eduName,$department];
                $result = checkStatus($education->update($col,$val,Session::get('edu_id')));
                if(!checkError($result)){
                    $error = false;
                    $message = $eduName." updated successfully";
                }else{
                    $error = true;
                    $message = $eduName." update unsuccessful";
                }
            }

        }else{
            $errorForm = true;
            $message = "Education Name is empty";
        }
    }
?>

    <div class="content">
        <?php require_once "include/navbar.php" ?>
        <div class="headline">
            <h2><?php echo $header; ?></h2>
        </div>

        <?php if(isset($error) && isset($message) && !$errorForm) {
            if(!$error){
                ?>
                <span class="label success mt-2"><?php echo $message;?></span>
            <?php }else{
                ?>
                <span class="label danger mt-2"><?php echo $message;?></span>
            <?php
        } }?>

        <div class="m-3 d-flex justify-content-center">
            <div class="w-30 card white">
                <form action="edit_education.php" method="post">
                    <span>Education Name</span>
                    <input type="text" name="edu_name" value="<?php echo isset($oldEduName)?$oldEduName:null ?>"/>
                    <span>Departments</span>
                    <input type="text" name="department" value="<?php echo isset($oldDepartment)?$oldDepartment:null?>"/>
                    <div class="text-center mt-2">
                        <?php
                            if(!$update) {
                        ?>
                                <input class="btn primary" type="submit" value="Add Education" name="create" />
                        <?php
                            }else{
                        ?>
                                <input class="btn primary" type="submit" value="Update Education" name="update" />
                        <?php } ?>
                    </div>
                </form>

                <div>
                    <span class="label-error"><?php echo $errorForm?$message:null; ?></span>
                </div>
            </div>
        </div>
    </div>

<?php require_once "include/footer.php" ?>