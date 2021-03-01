<?php $title = "Page de messagerie"; ?>
<?php include('partials/_header.php'); ?>



<div class="container">
    <div class="row">  
      <?php foreach($users as $user) : ?>
        <div class="card card-text lead bg-secondary text-white shadow">
          <h5 >Discussion avec <?php echo $user->pseudo?><?php ?>  </h5> 
        </div>
     
      <?php endforeach; ?>     
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script>

    //message
    
    $(document).ready(function(){
      if((document.getElementById('msg'))){
      document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight;
      }
      $('#envoyer').on("submit", function(e){
        e.preventDefault();
        
        var id;
        var message;
        
        id = <?=json_encode($_GET['id'], JSON_UNESCAPED_UNICODE);?>;
        message = document.getElementById('messagerie').value;
        
        document.getElementById('messagerie').value = "";
        
        if(id > 0 && message != ""){
          $.ajax({
            url : 'ajax/envoyer_message.php',
            method: 'POST',
            dataType : 'html',
            data : {id: id, message: message},
            
            success : function(data){
              
              $('#afficher-message').append(data);
              
              document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight;
              // document.location.reload();
            },
            
            error : function(e, xhr, s){
              let error = e.responseJSON;
              if(e.status == 403 && typeof error !== 'undefined'){
                alert('Erreur 403');
              }else if(e.status == 403) {
                alert('Erreur 403');
              } else if(e.status == 401){
                alert('Erreur 401');
              }else {
                alert('Erreur Ajax');
              }
            }
          });
        }
      
      });
      
      var chargement_message_auto = 0;

      chargement_message_auto = clearInterval(chargement_message_auto);

      chargement_message_auto = setInterval(chargerMessageAuto, 1000) ;
      

      
      function chargerMessageAuto(){
        
        var id = <?=json_encode($_GET['id'], JSON_UNESCAPED_UNICODE);?>;
        if(id >0){
          $.ajax({
            url : 'ajax/charger_message.php',
            method: 'POST',
            dataType : 'html',
            data : {id: id},
            
            success : function(data){
              if(data.trim() != ""){
                $('#afficher-message').append(data);
               
                document.getElementById('msg').scrollTop = document.getElementById('msg').scrollHeight;
                // document.location.reload();
               
              }
              
            },
            error : function(e, xhr, s){
              let error = e.responseJSON;
              if(e.status == 403 && typeof error !== 'undefined'){
                alert('Erreur 403');
              }else if(e.status == 403) {
                alert('Erreur 403');
              } else if(e.status == 401){
                alert('Erreur 401');
              }else {
                alert('Erreur Ajax');
              }
            }
          });
        }
        
      }
      <?php 
      $nombre_total_message = 25;
      
      $q=$db->prepare("SELECT COUNT(id) nbMessage FROM messagerie 
                      WHERE ((id_from, id_to) = (:id1, :id2) OR (id_from, id_to) = (:id2, :id1))                               
                      ");
      $q->execute(['id1'=> $_SESSION['user_id'], 'id2' => $_GET['id']]);
      
      $nombre_message = $q->fetch();
        if($nombre_message['nbMessage'] > $nombre_total_message) {
        ?>
          var req = 0;
        
          $('#voir-plus').click(function(){
            var id ;
            var el ;
            req += <?=$nombre_total_message?>;
            id = <?=json_encode($_GET['id'], JSON_UNESCAPED_UNICODE);?>;
            $.ajax({
              url : 'ajax/voir_plus_messages.php',
              method: 'POST',
              dataType : 'html',
              data : {limit: req, id: id},
              
              success : function(data){
                
                  $(data).hide().appendTo('#voir-plus-message').fadeIn(2000);
                  document.getElementById('voir-plus-message').removeAttribute('id') ;
                              
              },
              error : function(e, xhr, s){
                let error = e.responseJSON;
                if(e.status == 403 && typeof error !== 'undefined'){
                  alert('Erreur 403');
                }else if(e.status == 403) {
                  alert('Erreur 403');
                } else if(e.status == 401){
                  alert('Erreur 401');
                }else {
                  alert('Erreur Ajax');
                }
              }
            });
            
          });
      
        
        <?php 
          }
        
      ?>
    });
</script>

<?php  include('partials/_footer.php');?>