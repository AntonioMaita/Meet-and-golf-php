<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>



<div class="container">
    <div class="row">           
        <div class="col-sm-12">
            <div class="corps-des-messages" id="msg">
                <?php 
                    if($nombre_message['nbMessage'] > $nombre_total_message) {
                ?>
                <button id="voir-plus" class="btn-voir-plus-message">Voir plus</button>
                <?php 
                    }
                ?>
                <div id="voir-plus-message"></div>
                <?php foreach($afficher_message as $am ) {               
                    
                    if($am->id_from == $_SESSION['user_id']) {?>
                    
                        <div class="message-gauche">                                
                            <?=nl2br(replace_links($am->message));
                            
                            ?>                                 
                            
                        </div >                         
                    <?php }else { ?>   
                        <div class="message-droit">                                            
                            <?=nl2br(replace_links($am->message));
                            
                            ?> 
                                                   
                        </div> 
                        <?php } 
                            }
                        ?>                      
                <div id ="afficher-message"></div>  
                                          

            </div>      

        </div>
        
        <div class="col-sm-12">
            <?php if(isset($er_message)){
                echo $er_message;
            } ?>
            <div style="border: 1px solid #cccccc; border-radius: 5px; position: relative; padding-top: 5px; background: white">
            <form id="envoyer" method="post"> <br>               
                <textarea  id="messagerie" name="messagerie" rows = "5" placeholder="Votre message..."
                    data-parsley-maxlength="150"
                   style="border: none;overflow: none; resize: none; width: 90%; outline: none; padding: 0 5px"></textarea><br>
                <input type="submit"  class="btn btn-success btn-xl float-start" value="Envoyer" name="envoyer" > 
                
            </form>
            </div><br> 
        </div>          

         
    </div>


</div>

<?php  include('partials/_footer.php');?>