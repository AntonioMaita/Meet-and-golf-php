<?php $title = "Liste de contact"; ?>
<?php include('partials/_header.php'); ?> <br>

<div class="card col-md-6 bg-dark">
<h5 class="card-title text-white col-md-6">Liste de contact </h5>
<?php if(!empty($afficher_contact)) : ?>
    <?php foreach($afficher_contact as $ac) :?> 
          
         <a class="nav-link text-white" href="message.php?id=<?=$ac->id?>"><?=$ac->pseudo?></a>

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
    <?php endforeach; ?>
<?php else : ?>
    <p class="card text-white bg-dark">Aucun ami pour l'instant</p>
        
        
<?php endif; ?>
    </div>

    <?php  include('partials/_footer.php');?>