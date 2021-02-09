<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>


<div class="row col-md-6">
    <div class="card bg-dark shadow">

        <div class="card-header bg-dark mb3">      
            
            <p class="card bg-dark text-white">Messages avec <?=$user->pseudo?></p> 
            <?php foreach($afficher_message as $am ) : ?> 
            <div class="card bg-dark text-dark">
                <div  class="card bg-dark text-white"> 
                    
                    <?php if(!empty($am)) :?>
                    <?php if($am->id_from == get_session('user_id')) :?>
                        
                            <p class="card text-dark">Vous avez écrit :</p>
                            <p id ="afficher-message" class="card text-dark "><?=nl2br(replace_links(e($am->message)))?></p>
                    <?php else : ?>   
                            
                        <p class="card  bg-secondary"><?=$user->pseudo?> a écrit :</p>           
                        <p id ="charger-message"class="card  bg-secondary"><?=nl2br(replace_links(e($am->message)))?></p>
                    <?php endif; ?> 

                        <p class="card bg-dark ">Envoyé le <?= date('d-m-Y à H:i:s',strtotime($am->date_message))?> </p> 
                        <hr>
                    <?php  else :?>

                        <p>Pas de message</p>

                    <?php endif; ?> 
            
                </div> <br>
                <?php endforeach; ?>
        
            
                <div  class=" card bg-dark col-md-12">
                <?php if(isset($er_message)) {
                    echo $er_message ;
                } ?>
                        <form id="envoyer" method="post">                
                            <textarea  id="message" name="message"  rows="5" placeholder="Votre message..."
                                class=" col-md-12" data-parsley-maxlength="150"></textarea><br>
                                <input type="submit"  class="btn btn-success btn-xl float-start" value="Envoyer" name="envoyer" > 
            
                        </form>
                </div>
            </div>
              
        </div> 
    </div>
</div>

<?php  include('partials/_footer.php');?>