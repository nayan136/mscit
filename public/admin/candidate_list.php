
<?php require_once "include/header.php" ?>
<?php require_once "include/sidebar.php" ?>

<?php
    $user = new User();
    $result = checkStatus($user->getCandidate(),"No Candidate Found");
    if(!checkError($result)){
        $candidates = getData($result);
    }else{
        $error = getData($result)[0];
    }
?>

<div class="content">
    <?php require_once "include/navbar.php" ?>
    <div class="headline">
        <h2>Candidate List</h2>
        <h4 class="secondary-text">Total Candidate: <?php echo isset($candidates)?count($candidates):0?></h4>
    </div>
    <h2>
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
                    $i = 0;
                    foreach ($candidates as $candidate){
                     $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $candidate["user_name"]; ?></td>
                            <td><?php echo $candidate["email"]; ?></td>
                            <td><?php echo $candidate["user_address"].", ".$candidate["user_city"].", ".$candidate["user_state"]; ?></td>
                        </tr>
                <?php
                    }
                ?>

            </tbody>
        </table>
    </div>
</div>

<?php require_once "include/footer.php" ?>
