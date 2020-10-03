<div class = "d-flex justify-content-center">
<form action="/task/create" method="post" class="mt-4">
    <div class="form-group">
        <label for="InputUsername">Username</label>
        <input type="text" class="form-control" name="username" id="InputUsername" required>
    </div>
    <div class="form-group">
        <label for="InputEmail">Email</label>
        <input type="email"  class="form-control" name="email" id="InputEmail" required>
    </div>
    <div class="form-group">
        <label for="validationTextarea">Text</label>
        <textarea class="form-control" name="text" id="validationTextarea" required></textarea>
    </div>
    <input class="btn btn-primary" type = "submit" value="Create">
</form>
</div>