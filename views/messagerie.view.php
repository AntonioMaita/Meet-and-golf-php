<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>

<div class="container">
    <div class="row ">
        <h3 class="card bg-dark text-white">Messagerie</h3>
        <?php foreach($afficher_conversation as $ac) {?> 
        <div class="card col-md-3 bg-dark m-2 shadow" style="height: auto;">
        
            <div>        
               
                    <a href="message.php?id=<?=$ac->id?>" class="nav-link logo"  role="button" aria-expanded="false">                
                            <?php                 
                            
                            if(!empty($ac->avatar)) {                                                                                                                                    
                            ?>
                            
                                <img class="avatar rounded" src="assets/avatars/<?php echo $ac->avatar;?>" alt="avatar" width="30px" height="30px"/> 
                            <?php } else { ?> 
                                <img class="rounded-circle rounded " src="assets/avatars/defaults/default.png" alt="default" width="30px" height="30px"/>
                            <?php } ?>
                            <?=$ac->pseudo?>
                    </a>
                    
                

                <?php if($ac->id_from != get_session('user_id') && $ac->lu == "1") : ?>
                
                    <p class="text-white">Nouveau message reçu :</p>
                    
                    <?php endif;?>
                    <?php if(isset($ac->message)) :?>
                        <a class="nav-link" href="message.php?id=<?=$ac->id?>">
                            <div class="">
                                <p class=""><?=$ac->message?> </p>
                                
                                <?php endif;?>
                                <?php if(isset($ac->date_message)) :?>
                                <p class="">Envoyé le <?= date('d-m-Y à H:i:s',strtotime($ac->date_message))?> </p>
                                <?php endif;?>
                            </div>
                        </a>
                

            </div>
        </div>      
       
        <?php } ?>                   
                                    
    </div>         
    
</div>

<?php  require('partials/_footer.php');?>