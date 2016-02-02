<Div Align="right">
<?php
$user_name = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_name = $_POST['user_name'];
}
?>
<form action="" method="POST">
    <input type="text" name="user_name" placeholder="user name" value="
<?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8')?>">
    <input type="text" name="user_pass" placeholder="user pass">
    <input type="submit" value="Check!">
</form>
    <h3><a href="./user_form">create user</a></h3>
    <h3><a href="./thread_form">create thread</a></h3>
</Div>
