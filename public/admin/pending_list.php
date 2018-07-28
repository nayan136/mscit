<?php require_once "include/header.php" ?>
<?php require_once "include/sidebar.php" ?>
<?php
    $user = new User();
//  approve
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!empty($_POST["approve"])){
            $update = checkStatus($user->approveRecruiter($_POST["approve"]));
            $approveError = true;

            if(!checkError($update)){
                $username = getData($update)[0]["user_name"];
                $message = $username." has been approved";
                $approveError = false;
            }else{
                $message = "User cannot be approved";
            }
        }
    }
//  get data
    $result = checkStatus($user->getPendingList(),"No Pending Recruiter Found");
    if(!checkError($result)){
        $recruiters = getData($result);
    }else{
        $error = getData($result)[0];
    }

?>

    <div class="content">
        <?php require_once "include/navbar.php" ?>
        <div class="headline">
            <h2>Pending Recruiter List</h2>
            <h4 class="secondary-text">Total Pending Recruiter: <?php echo isset($recruiters)?count($recruiters):0?></h4>
        </div>
        <?php if(isset($message) && isset($approveError)) {
            if(!$approveError){
        ?>
                <span class="label success mt-2"><?php echo $message;?></span>
        <?php }else{
        ?>
                <span class="label danger mt-2"><?php echo $message;?></span>
        <?php
            } }?>

        <h2 class="m-3">
            <?php
            isset($error)?die($error):null;
            ?>
        </h2>

        <div class="m-3 d-flex justify-content-center">
            <table class="w-70 table">
                <thead>
                <tr>
                    <td>Sl No</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Approve</td>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($recruiters as $k=>$recruiter){
                    ?>
                    <tr>
                        <td><?php echo ++$k; ?></td>
                        <td><?php echo $recruiter["user_name"]; ?></td>
                        <td><?php echo $recruiter["email"]; ?></td>
<!--                        <td>--><?php //echo $recruiter["user_address"].", ".$recruiter["user_city"].", ".$recruiter["user_state"]; ?><!--</td>-->
                        <td class="text-center">
                            <form class="all-0" action="pending_list.php" method="post">
                                <input type="hidden" name="approve" value="<?php echo $recruiter["id"]?>" />
                                <input class="btn primary" type="submit" value="Approve"/>
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