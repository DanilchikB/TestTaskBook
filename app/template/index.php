

<div class="cards">
<div class="text-center mt-4">
    <div class="btn-group">
    <button type="button" data-type="sort" data-name="username" class="btn btn-secondary sort-button">Username<span></span></button>
    <button type="button" data-type="sort" data-name="email" class="btn btn-secondary sort-button">Email<span></span></button>
    <button type="button" data-type="sort" data-name="completed" class="btn btn-secondary sort-button">Completed<span></span></button>
    </div>
</div>
<div id = "cards-task">
<?php foreach($tasks as $value){?>
    <div class="card border-dark mt-4 card-task">
        <div class="card-header">
            <span>
            <?php if($value['completed'] === '0'){
                echo '&#10060;';
            }else{
                echo '&#9989;';
            }
            ?>
            </span>
            <span>
            <?=$value['username']?>
            </span>
            <?php if($value['edit'] === '1'){?>
                <span class="text-secondary float-right">
                Edited
            </span>
            <?php }?>
            
        </div>
        <div class="card-body text-dark">
            <h5 class="card-title"><?=$value['email']?></h5>
            <p class="card-text"><?=$value['text']?></p>
            <?php if(isset($auth) && $auth){?>
            <a class="btn btn-warning update-button" href="/update?id=<?=$value['id']?>">Update</a>
            <?php }?>
        </div>
    </div>
<?php }?>
</div>
<?php if($countPages > 1){ ?>
<div class="mt-4 text-center">
    <nav class="btn-group">
    <ul class="pagination">
        <?php for($i=1;$i<=$countPages;$i++){?>
        <li id ="pagination-<?=$i?>" data-type="page" data-id="<?=$i?>" class="page-item pagination-button">
            <button  class="page-link">
            <?=$i?>
            </button>
        </li>
        <?php }?>
    </ul>
    </nav>
</div>
<?php }?>
</div>