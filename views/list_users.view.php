<?php $title = "Page liste d'utilisateur"; ?>
<?php include('partials/_header.php'); ?>




<div class="container">

    <div class="row listeutilisateurs">
        
        <div class="card shadow text-white bg-success">
            
                <h1 class="card-title shadow">Liste des utilisateurs</h1>
                
                    <?php foreach($users as $user) : ?>   
                
                    <div class="listuser card  bg-dark">                          
                            <?php if ($user->avatar) { ?>

                        <a href="profile.php?id=<?=e($user->id)?>">       
                            <img class="avatar rounded-circle" src="assets/avatars/<?php echo $user->avatar;?>" alt="avatar" width="60px" height="60px"/>
                        </a>  
                            <?php } else {?>
                        <a href="profile.php?id=<?=e($user->id)?>">
                                <img class="avatar rounded-circle" src="assets/avatars/defaults/default.png" alt="default" width="60px" height="60px"/>
                                    <?php } ?>
                        </a>
                        
                        <h6 class="user-block-username">
                            <a class="link-dark nav nav-link text-white " href="profile.php?id=<?=e($user->id)?>">
                                <?= e($user->pseudo); ?> <p><?=e($user->club)?></p> 
                            </a>
                            
                        </h6>                                                                      
                        
                    </div> <br>
                
                    <?php endforeach ?>

                    
                
                <div id="pagination"><?=$pagination?></div>                   
                
            
        </div>
        
    </div>
</div>

<?php include('partials/_footer.php'); 