

<div class="cards">
<div class="text-center mt-4">
    <div class="btn-group">
    <button type="button" class="btn btn-secondary">Username</button>
    <button type="button" class="btn btn-secondary">Email</button>
    <button type="button" class="btn btn-secondary">Compteted</button>
    </div>
</div>
<div id = "cards-task">
<?php foreach($tasks as $value){?>
    <div class="card border-dark mt-4 card-task">
        <div class="card-header">
            <div>
            <?php if($value['completed'] === '0'){
                echo '&#10060;';
            }else{
                echo '&#9989;';
            }
            ?>
            </div>
            <div>
            <?=$value['username']?>
            </div>
        </div>
        <div class="card-body text-dark">
            <h5 class="card-title"><?=$value['email']?></h5>
            <p class="card-text"><?=$value['text']?></p>
        </div>
    </div>
<?php }?>
</div>
<?php if($countPages > 1){ ?>
<div class="mt-4 text-center">
    <nav class="btn-group">
    <ul class="pagination">
        <?php for($i=1;$i<=$countPages;$i++){?>
        <li id ="pagination-<?=$i?>" data-id="<?=$i?>" class="page-item pagination-button 
        <?php if($i===$current) echo 'current-page'?>">
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