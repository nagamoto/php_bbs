<?php
session_start();
if (!isset($_SESSION['user_id'])){
    exit;
}
?>
<Div Align="center">
    <h2>comment_form</h2>
    <form action="./comments_receiver" method="POST">
    <table>
        <tr>
            <td>comment area:</td>
            <TEXTAREA cols="30" rows="5" name="text"></TEXTAREA>
            </tr>
    </table>
        <input type="hidden" name="thread_id" value=<?php echo $get_id?>>
        <input type="submit" value="create">
    <input type="submit" value="cancel">
</form>
</Div>
