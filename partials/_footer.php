  
  <div class ="card-footer bg-dark text-white">Meet and golf &copy 2021</div>
  
  <!-- JavaScript Bundle with Popper -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  
  <script src="assets/js/jquery.timeago.js"></script>
  <script src="assets/js/jquery.timeago.fr.js"></script> 
  <script src="assets/js/jquery.livequery.min.js"></script>       
  <script src="libraries/parsley/parsley.min.js" ></script>
  <script src="libraries/parsley/i18n/fr.js" ></script>
  <script type="text/javascript">
    window.ParsleyValidator.setLocale('fr');
    jQuery(document).ready(function() {
      jQuery(".timeago").timeago(); 

      $("a.like").on("click", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = 'ajax/micropost_like.php';
        var action = $(this).data('action');        
        var micropostId = id.split('like')[1];
        // alert(micropostId);
        $.ajax({
          type : 'POST',
          url: url,
          data: {
            micropost_id : micropostId,
            action : action
          },          
            success: function(likers){  
               $("#likers_" + micropostId).html(likers);
                        
              if(action == 'like'){
                $("#" + id).addClass("btn  text-primary  fas fa-thumbs-up ").data('action', 'unlike').html("Je n'aime plus");
              }else {
                $("#" + id).toggleClass("text-primary ").data('action', 'like').html("J'aime");
              }
            }
                  
        });      
      });

      $("a.likePost").on("click", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = 'ajax/post_like.php';
        var action = $(this).data('action');        
        var postId = id.split('likePost')[1];
        
        $.ajax({
          type : 'POST',
          url: url,
          data: {
            post_id : postId,
            action : action
          },          
            success: function(likers_post){   
              $("#likers_" + postId).html(likers_post);
              if(action == 'likePost'){
                $("#" + id).addClass("btn  text-primary  fas fa-thumbs-up ").data('action', 'unlikePost').html("Je n'aime plus");
              }else {
                $("#" + id).toggleClass("text-primary ").data('action', 'likePost').html("J'aime");
              }
            }
                  
        });      
      });

      $("a.likeMicropostPost").on("click", function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var url = 'ajax/micropostPost_like.php';
        var action = $(this).data('action');        
        var micropostPostId = id.split('likeMicropostPost')[1];
        
        $.ajax({
          type : 'POST',
          url: url,
          data: {
            micropostPost_id : micropostPostId,
            action : action
          },          
            success: function(likers){   
              $("#likers_" + micropostPostId).html(likers);   
              if(action == 'likeMicropostPost'){
                $("#" + id).addClass("btn  text-primary  fas fa-thumbs-up ").data('action', 'unlikeMicropostPost').html("Je n'aime plus");
              }else {
                $("#" + id).toggleClass("text-primary ").data('action', 'likeMicropostPost').html("J'aime");
              }
            }
                  
        });      
      });


    });

  </script>
  

</body>
</html>