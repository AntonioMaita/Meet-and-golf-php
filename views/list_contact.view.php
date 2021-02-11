<?php $title = "Liste de contact"; ?>
<?php include('partials/_header.php'); ?> 


<div class="container">
    <?php if(!empty($afficher_contact)) : ?>
        <div class="row ">
            <h3 class="card bg-dark text-white">Liste d'amis</h3>
            
            <?php foreach($afficher_contact as $ac) {?> 
                <div class="card col-md-3 bg-dark m-2 shadow" style="height: 70px;">
                
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
                    </div>
                </div>
            <?php } ?>
                    
        </div> 
    <?php else : ?>
        <p class="card text-white bg-dark">Aucun ami pour l'instant</p>     
                
    <?php endif; ?>       
            
</div>

    <?php  include('partials/_footer.php');?>