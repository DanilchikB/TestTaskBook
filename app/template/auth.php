<form action="/user/auth" method="post">
    <input type="text" name="username">
    <input type="password" name = "password">
    <input type="submit">
</form>
<?php if($fail) { ?>
    <p>Неправильный логин или пароль</p>

<?php }?>
