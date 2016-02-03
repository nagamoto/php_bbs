<Div Align="right">
<?php if ($_SESSION["USERID"]){?>
    <h3>welcome <?php print $_COOKIE["user_name"]?></h3>
    <form action="/bbs/view/users_receiver" method="POST">
        <input type="submit" name = "sign_out" value="sign_out">
    </form>
<?php }?>
    <h3><a href="/bbs/view/parts/user_form">sign in / create user</a></h3>
    <h3><a href="/bbs/view/parts/thread_form">create thread</a></h3>
</Div>
