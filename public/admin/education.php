<?php require_once "include/header.php" ?>
<?php require_once "include/sidebar.php" ?>
<?php
    $education = new Education();
//   delete
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST["delete"])){
            $delete = checkStatus($education->delete($_POST["delete"]));
            $deleteError = true;

            if(!checkError($delete)){
//                $eduName = getData($delete)[0]["edu_name"];
//                $message = $eduName." has been deleted";
                $message = "Delete successful";
                $deleteError = false;
            }else{
                $message = "Error";
            }
        }
    }

//  get data
    $result = checkStatus($education->index());
    if(!checkError($result)){
        $educations = getData($result);
    }else{
        $error = getData($result)[0];
    }
?>

    <div class="content">
        <?php require_once "include/navbar.php" ?>
        <div class="headline">
            <h2>Education List</h2>
        </div>

        <?php if(isset($message) && isset($deleteError)) {
            if(!$deleteError){
                ?>
                <span class="label success mt-2"><?php echo $message;?></span>
            <?php }else{
            ?>
                <span class="label danger mt-2"><?php echo $message;?></span>
            <?php
            }
        }?>

        <h2 class="m-3">
            <?php
            isset($error)?die($error):null;
            ?>
        </h2>

<!--        <div class="p-3">-->
<!--            <a class="m-3 btn success">Add Education</a>-->
<!--        </div>-->

        <div class="m-3 d-flex flex-column item-center">
            <div class="w-70 m-3">
                <a href="edit_education.php" class="btn success">Add Education</a>
            </div>
            <table class="w-70 table">
                <thead>
                <tr>
                    <td>Sl No</td>
                    <td>Education Name</td>
                    <td>Departments</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($educations as $k=>$education){
                ?>
                    <tr>
                        <td><?php echo ++$k; ?></td>
                        <td><?php echo $education["edu_name"]; ?></td>
                        <td><?php echo $education["department"]; ?></td>
                        <td class="text-center"><a href="edit_education.php?edu_id=<?php echo $education["id"]; ?>" class="btn warning">Edit</a></td>
                        <td class="text-center">
                            <form class="all-0" action="education.php" method="post">
                                <input type="hidden" name="delete" value="<?php echo $education["id"]?>" />
                                <input class="btn danger" type="submit" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>

    </div>


<?php require_once "include/footer.php" ?>