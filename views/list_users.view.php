<?php $title = "Page liste d'utilisateur"; ?>
<?php include('partials/_header.php'); ?>


<div class="container">
    <?php if(!empty($users)) : ?>
        <div class="row ">
            <h3 class="card bg-dark text-white">Liste des utilisateurs</h3>
            
            <?php foreach($users as $user) { ?> 
                <div class="card col-md-3 bg-dark m-2 shadow" style="height: 70px;">
                
                    <div>
                    
                            <a href="profile.php?id=<?=e($user->id)?>" class="nav-link logo"  role="button" aria-expanded="false">                
                                    <?php                 
                                    
                                    if(!empty($user->avatar)) {                                                                                                                                    
                                    ?>
                                    
                                        <img class="avatar rounded" src="assets/avatars/<?php echo $user->avatar;?>" alt="avatar" width="30px" height="30px"/> 
                                    <?php } else { ?> 
                                        <img class="rounded-circle rounded " src="assets/avatars/defaults/default.png" alt="default" width="30px" height="30px"/>
                                    <?php } ?>
                                    <?=$user->pseudo?> <br>
                                    <?=e($user->club)?>
                            </a>
                    </div>
                </div>
            <?php } ?>
                    
        </div> 
    <?php else : ?>
        <p class="card text-white bg-dark">Aucun utilisateur pour l'instant</p>     
                
    <?php endif; ?>       
            
</div> 

<div id="pagination"><?=$pagination?></div>                   
                
       

<?php include('partials/_footer.php'); 