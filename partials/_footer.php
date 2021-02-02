  
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

      // $("a.like").on("click", function(e) {
      //   e.preventDefault();

      //   var id = $(this).attr("id");
      //   var url = 'ajax/micropost_like.php';
      //   var action = $(this).data('action');
      //   var micropostId = id.split("like")[1];
        
      //   $.ajax({
      //     type : 'POST',
      //     url: url,
      //     data: {
      //       micropost_id : micropostId,
      //       action : action
      //     },
      //     success: function(response){
              
      //       if(action == 'like'){
      //         $("#" + id).addClass("btn  text-primary  fas fa-thumbs-up ").data('action', 'unlike').html("Je n'aime plus");
      //       }else {
      //         $("#" + id).toggleClass("text-primary ").data('action', 'like').html("J'aime");
      //       }
      //     }
      //   });

        
      // });

      
    });

  </script>
  

</body>
</html>