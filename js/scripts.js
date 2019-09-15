$(function(){
    var container = $("#container_titulo")
        userText = $('#userText'); 
    container.shuffleLetters();
    userText.click(function () {
        
      userText.val("");
      
    }).bind('keypress',function(e){      
        if(e.keyCode == 13){          
            container.shuffleLetters({
                "text": userText.val()
            });
            
            userText.val("");
        }
    }).hide();
    setTimeout(function(){

        container.shuffleLetters({
            "text": ""
        });       
        userText.val("").fadeIn();        
    },25000);    
});

if('#botao') {
      
    function menuResponsive(){ 
        document.getElementById('menuResponsive').style.display = 'block';
        
        
    }
    
}
      
    



