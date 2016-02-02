<?php
$thread_title = '';
$text = '';
?>
<Div Align="center">
    <h2>thread_form</h2>
    <form action="" method="POST">
    <table>
        <tr>
        <td>title:</td>
        <td><input type="text" name="thread_title" placeholder="title" value="
        <?php echo htmlspecialchars($thread_title, ENT_QUOTES, 'UTF-8')?>"></td>
        </tr>
        <tr>
            <td>textarea:</td>
            <TEXTAREA cols="30" rows="5" name="text" value="
        <?php echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8')?>">デフォルト値</TEXTAREA>            </tr>
            </tr>
    </table>
    <input type="submit" value="update">
    <input type="submit" value="cancel">
</form>
</Div>
