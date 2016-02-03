<Div Align="right">
<?php if (isset($_COOKIE["PHPSESSID"])){?>
    <h3>welcome, <?php print $_COOKIE["user_name"]?></h3>
<?php }?>
    <h3><a href="/bbs/view/parts/user_form">sign in / create user</a></h3>
    <h3><a href="/bbs/view/parts/thread_form">create thread</a></h3>
</Div>
