function animacao(){
    /* $('.home-logo').children().animate({width: '0px'}, 'slow').animate({height: '0px'}, 'slow');
    $('.home-logo').children().animate({width: '250px'}, 'slow').animate({height: '250px'}, 'slow'); */
    $('#video').animate({width: '0px'}, 'slow').animate({height: '0px'}, 'slow');
    $('#video').animate({width: '250px'}, 'slow').animate({height: '250px'}, 'slow');
    $('#imageAustro').animate({left:'15%'},'slow',function() {
        // Adicione a classe de inversão quando a animação atingir a posição desejada
        $(this).css('transform','scaleX(1)');
       
      })
    $('#imageAustro').animate({left: '75%'}, 'slow',function() {
        // Adicione a classe de inversão quando a animação atingir a posição desejada
        $(this).css('transform','scaleX(-1)');
        
      });
    
    }
setInterval(animacao,6000)

function funcaocarregar(){
  var elemento = document.querySelectorAll(".actions")
  elemento.style.opacity = 4
}