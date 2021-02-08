<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>


<div class="row">
<?php foreach($afficher_conversation as $ac) {?> 
    <div class="card col-md-6 bg-dark">
     
        
        <div class="card-header text-white bg-success mb-3 shadow ">
               
                        <h3 class="card-title">Messagerie <a href="message.php?id=<?=$ac->id?>"><?=$ac->pseudo?></a></h3>                        
        </div>
       <?php if($ac->id_from == get_session('user_id') && $ac->lu == "1") : ?>
        
        <p class="text-white">Nouveau</p>
        
        <?php endif;?>
        <?php if(isset($ac->message)) :?>
        <p class="card"><?=$ac->message?> </p>
        <?php endif;?>
        <?php if(isset($ac->date_message)) :?>
        <p class="card">Reçus le <?= date('d-m-Y à H:i:s',strtotime($ac->date_message))?> </p>
        <?php endif;?>
   
        
       
<?php } ?>
    <?php //endforeach;?>
        <div class="form-group">
            <form action="" method="post">
                
                <textarea  name="post id="" cols="50" rows="5" placeholder="Votre message..."
                    class="form-control" data-parsley-maxlength="150"></textarea><br>

                    <input type="submit" class="btn btn-success btn-xl float-end" value="envoyer" name="" >  <br> <br>
            </form>
              
        </div> 
        
                   
                                    
    </div>  
        
</div>

<?php  include('partials/_footer.php');?>