<?php
$user_name = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_name = $_POST['user_name'];
}
?>
<Div Align="center">
    <h2>user form</h2>
    <form action="" method="POST">
    <table>
        <tr>
        <td>name:</td>
        <td><input type="text" name="user_name" placeholder="user name" value="
        <?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8')?>"></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="text" name="user_pass" placeholder="user pass"></td>
            </tr>
            <tr>
            <td>password_confirm:</td>
            <td><input type="text" name="user_pass_confirm" placeholder="user pass confirm"></td>
            </tr>
    </table>
    <input type="submit" value="create">
    <input type="submit" value="cancel">
</form>
</Div>

