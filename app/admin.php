<?php
require_once("databaseClass.php");
if(isset($_POST['submit']) && isset($_POST['user_id'])){
    if(is_numeric($_POST['user_id'])){
        $newstatus = ["Accept"=>1,"Reject"=>2];
        if(isset($newstatus[$_POST['submit']])){
            if($DB->exec("UPDATE `users` set status = ? where id = ?"
            ,[$newstatus[$_POST['submit']] , $_POST['user_id']]
            )){
                echo "<div class='success'>Request status updated successfully!</div>";
            }
        }
    }
}
$users = $DB->fetchAll("SELECT * from `users` JOIN `roles` USING (`role_id`) ORDER BY `status` ASC");
echo "<p>Welcome sir, {".$_SESSION['user']['user_name']."}</p>";
$userStatus = [
    "Pending",
    "Active",
    "Rejected"
];
?>
<h2>User List ( Sorted By Pending )</h2>
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>User Role</th>
            <th>User Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach($users as $user){
            ?><tr>
                <td><?=$user['id']?></td>
                <td><?=$user['user_name']?></td>
                <td><?=$user['role_name']?></td>
                <td><?=$userStatus[$user['status']]?></td>
                <td>
                    <?php
                    if($user['status'] == 0){
                        ?>
                        <form method="post">
                            <input type="hidden" name="user_id" value="<?=$user['id']?>">
                            <input type="submit" name="submit" onclick="return confirm('Are you sure want to accept this request?');" value="Accept" class="customButton acceptButton">
                            <input type="submit" name="submit" onclick="return confirm('Are you sure want to reject this request?');" value="Reject" class="customButton rejectButton">
                        </form>
                        <?php
                    }
                    ?>
                </td>
            </tr><?php
        }
    ?>
    </tbody>
</table>
