
var url = 'ajax/search.php';

$('#searchbox').on('keyup', function(){
    var query = $(this).val();

    if(query.length >0) {
    
    $.ajax({
        type : 'POST',
        url: url,
        data: {
          
          query : query
        }, 
        beforeSend: function(){
            $("#spin").show();
        },         
          success: function(data){
            $("#spin").hide();
            $(".display-box").html(data).show();
            

            
          }
                
      });
    } else {
        $(".display-box").hide();
    }
    

});