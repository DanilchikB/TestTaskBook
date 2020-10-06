<div class = "d-flex justify-content-center">
<form action="/task/update" method="post" class="mt-4">
    <div>Username: <?=$task['username']?></div>
    <div>Email: <?=$task['email']?></div>
    <div class="form-group">
        <label for="validationTextarea">Text</label>
        <textarea class="form-control" name="text" id="validationTextarea" required><?=$task['text']?></textarea>
    </div>
    <div class="form-group">
        <label for="validationComleted">Completed</label>
        <input type="checkbox" name="completed" id="validationComleted" value="1" 
        <?php if($task['completed']==='1'){echo 'checked';}?>>
        <input type="hidden" name="last_completed" value="<?=$task['completed']?>">
        <input type="hidden" name="id" value="<?=$task['id']?>">
    </div>
    
    <input class="btn btn-warning" type = "submit" value="Update">
    <?php if($status) { ?>
        <div class="valid-feedback d-block text-center">
            Success!
        </div>
        
    <?php }else if($status!=null){?>
        <div class="invalid-feedback d-block text-center">
            Fail!
        </div>
    <?php }?>
</form>
</div>