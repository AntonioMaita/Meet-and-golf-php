<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>


<div class="row">

    <div class="card-header col-md-10 bg-dark">      
        
            
        <?php foreach($afficher_message as $am) {?> 
            <div class="card bg-dark"> Messages
                <?php if(isset($am->message)) :?>
                <p class="card"><?=$am->message?> </p>
                <?php endif;?>
                <?php if(isset($am->date_message)) :?>
                <p class="card">Reçus le <?= date('d-m-Y à H:i:s',strtotime($am->date_message))?> </p>
                <?php endif;?>
                <?php } ?>
            </div>
    </div>
</div>

<?php  include('partials/_footer.php');?>