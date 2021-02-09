<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>


<div class="row">
<?php foreach($afficher_conversation as $ac) {?> 
    <div class="card col-md-6 bg-dark">
     
        
        <p class="card-title text-white col-md-6">Messagerie <a class="nav-link text-white" href="message.php?id=<?=$ac->id?>"><?=$ac->pseudo?></a></p>

        <div class="card text-white bg-dark col-md-12">
            <a href="message.php?id=<?=$ac->id?>" class="nav-link"  role="button" aria-expanded="false">                
                    <?php                 
                    
                    if(!empty($ac->avatar)) {                                                                                                                                    
                    ?>
                    
                        <img class="avatar rounded justify-content-end" src="assets/avatars/<?php echo $ac->avatar;?>" alt="avatar" width="30px" height="30px"/> 
                    <?php } else { ?> 
                        <img class="rounded-circle rounded justify-content-end" src="assets/avatars/defaults/default.png" alt="default" width="30px" height="30px"/>
                    <?php } ?>
                </a>
        </div>
       <?php if($ac->id_from != get_session('user_id') && $ac->lu == "1") : ?>
        
        <p class="text-white">Dernier message reçu :</p>
        
        <?php endif;?>
        <?php if(isset($ac->message)) :?>
        <p class="card col-md-12"><?=$ac->message?> </p>
        
        <?php endif;?>
        <?php if(isset($ac->date_message)) :?>
        <p class="card col-md-12">Envoyé le <?= date('d-m-Y à H:i:s',strtotime($ac->date_message))?> </p>
        <?php endif;?>
   </div>
        
       
<?php } ?>   
        
        
                   
                                    
    </div>  
        
</div>

<?php  include('partials/_footer.php');?>