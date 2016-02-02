<?php
    ?>
<Div Align="center">
    <h2>thread_form</h2>
    <form action="./view/threads" method="POST">
    <table>
        <tr>
        <td>title:</td>
        <td><input type="text" name="title" placeholder="title" value="<?php echo htmlspecialchars($thread_title, ENT_QUOTES, 'UTF-8')?>"></td>
        </tr>
        <tr>
            <td>textarea:</td>
            <td><TEXTAREA cols="30" rows="5" name="text"></TEXTAREA></td>
            </tr>
    </table>
    <input type="submit" value="create">
    <input type="submit" value="cancel">
</form>
</Div>
