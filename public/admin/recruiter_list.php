<?php require_once "include/header.php" ?>
<?php require_once "include/sidebar.php" ?>
<?php
    $user = new User();
    $result = checkStatus($user->getActiveRecruiter(),"No active Recruiter Found");

    if(!checkError($result)){
        $recruiters = getData($result);
    }else{
        $error = getData($result)[0];
    }
?>

    <div class="content">
        <?php require_once "include/navbar.php" ?>
        <div class="headline">
            <h2>Active Recruiter List</h2>
            <h4 class="secondary-text">Total Active Recruiter: <?php echo isset($recruiters)?count($recruiters):0?></h4>
        </div>
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
                    <td>Address</td>
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
                        <td><?php echo $recruiter["user_address"].", ".$recruiter["user_city"].", ".$recruiter["user_state"]; ?></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>

<?php require_once "include/footer.php" ?>