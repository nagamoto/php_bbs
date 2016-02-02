<?php
include "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_id = 1;
    $title = filter_input( INPUT_POST, "thread_title" );
    $text = filter_input( INPUT_POST, "thread_text" );
    print $title;
    print $text;
    $stmt = $db->prepare("INSERT into threads (title, text, user_id) values (?, ?, ?)");
    $stmt->execute([$title, $text, $user_id]);
}
else {
    $get_id = filter_input( INPUT_GET, "id" );
    $post_id = filter_input( INPUT_POST, "id" );
    $delete_id = filter_input( INPUT_DELETE, "id" );
}
try {
$db = new PDO(PDO_DSN, DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($delete_id) {
exit;
}
if ($get_id) {
    $stmt = $db->prepare("SELECT th.id, th.title, th.created_at, th.text, users.name FROM threads AS th inner join users ON th.user_id = users.id WHERE th.id = ? ORDER BY th.created_at");
    $stmt->execute([$get_id]);
    $thread = $stmt->fetch(PDO::FETCH_BOTH)?>
<table Align="center">
    <tr>
        <td>title:</td>
        <td><?php print $thread['title']?></td>
        </tr>
    <tr>
        <td>create user:</td>
        <td><?php print $thread['name']?></td>
    </tr>
    <tr>
        <td>created_at:</td>
        <td><?php print $thread['created_at']?></td>
        </tr>
</table>
    <Div Align="center">
<?php print $thread['text']?>
</Div>


    <table Align="center">
        <tr>
            <td>title:</td>
            <td><?php print $thread['title']?></td>
        </tr>
        <tr>
            <td>create user:</td>
            <td><?php print $thread['name']?></td>
        </tr>
        <tr>
            <td>created_at:</td>
            <td><?php print $thread['created_at']?></td>
        </tr>
    </table>

    <?php



}
else{



}
} catch (PDOException $e) {
print('Error:'.$e->getMessage());
echo $e->getMessage();
    exit;
}

include "footer.php";
