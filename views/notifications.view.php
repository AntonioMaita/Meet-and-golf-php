<?php $title = "Notifications"; ?>
 <?php include('partials/_header.php'); ?>

 <div id="main-content">
    <div class="container">
        <h1 class="lead card card-text bg-light">Vos notifications</h1>

    <?php if(count($notifications) >= 0  ) : ?>
        <ul class="list-group">

        

            <?php foreach($notifications as $notification): ?>
            <li class="list-group-item
            
                <?= $notification->seen == '0' ? 'bg-secondary' : '' ?>"
            >
            <?php require("partials/notifications/{$notification->name}.php"); ?>
            </li>
            <?php endforeach; ?>
            
        </ul>
        <div id="pagination"><?= $pagination ?></div>            
    </div>
</div>
<?php endif; ?>
 <?php  include('partials/_footer.php');?>