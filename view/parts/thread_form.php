<?php
include "header.php";
    $user_id = 1;
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = filter_input( INPUT_POST, "thread_title" );
        $text = filter_input( INPUT_POST, "thread_text" );
        print $title;
        print $text;
        $stmt = $db->prepare("INSERT into threads (title, text, user_id) values (?, ?, ?)");
        $stmt->execute([$title, $text, $user_id]);
    }
    ?>
<Div Align="center">
    <h2>thread_form</h2>
    <form action="./threads" method="POST">
    <table>
        <tr>
        <td>title:</td>
        <td><input type="text" name="thread_title" placeholder="title" value="
        <?php echo htmlspecialchars($thread_title, ENT_QUOTES, 'UTF-8')?>"></td>
        </tr>
        <tr>
            <td>textarea:</td>
            <td><TEXTAREA cols="30" rows="5" name="thread_text"></TEXTAREA></td>
            </tr>
    </table>
    <input type="submit" value="create">
    <input type="submit" value="cancel">
</form>
</Div>
<?php
include "footer.php";
