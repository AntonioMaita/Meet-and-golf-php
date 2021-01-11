<?php $title = "Page du mur"; ?>
<?php include('partials/_header.php'); ?>

<div class="main-content">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <form action="" method="post">
                    <label class="card-body bg-dark text-white question"for="post">Quoi de neuf <?=e($user->pseudo)?> ?</label> <br> <br>
                    <textarea name="post" id="post" cols="20" row="40" placeholder="Entrez votre sujet"
                        class="form-control"></textarea><br>

                        <input type="submit" class="btn btn-success col-md-6" value="Publier" name="postmessage" >  <br> <br>
                </form>
            </div>  
            
                                        
        </div>   

    </div>
    <div class="row">
        <div class="card-header text-white bg-success shadow fildactualite">
            <h6 class="lead card-text">Fil d'actualité</h6>
        </div>
        <div class="card card-body  bg-dark text-white messagepost">
                
                    <?php foreach($users as $user) : ?>                

                <div class="card card-text bg-dark shadow">
                    <p><?php echo $user->post?> </p>
                    <div class="card-group text-white bg-success shadow col-md-4">
                        <p> Publié par &nbsp;<a class="text-white" href="profile.php?id=<?=$user->users_id?>"><?=e($user->pseudo)?> </a>&nbsp; le <?=$user->date?></p>
                    </div> <br>
                </div>
                
                <?php endforeach ?>
                           
        </div>       
    </div>

</div>

<?php include('partials/_footer.php');