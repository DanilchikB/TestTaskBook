<div class = "d-flex justify-content-center">
<form action="/user/auth" method="post" class="mt-4">
    <div class="form-group">
        <label for="InputUsername">Username</label>
        <input type="text" class="form-control" name="username" id="InputUsername" required>
    </div>
    <div class="form-group">
        <label for="InputPassword">Password</label>
        <input type="password" class="form-control" name="password" id="InputPassword" required>
    </div>
    <input class="btn btn-primary" type="submit" value="Sign in">

    <?php if($fail) { ?>
        <div class="invalid-feedback d-block text-center">
            Incorrect login or password
        </div>
        
    <?php }?>
</form>

</div>
