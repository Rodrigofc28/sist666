


console.log('oinbvnvbn');

function adicionarCirculogenerico(event,id,idimg) {
    const imaFinal = document.getElementById(id);
    const canvass = document.createElement('canvas');
    const ctxx = canvass.getContext('2d');
    canvass.width = imaFinal.clientWidth; //para obter as dimensões visíveis da imagem após o redimensionamento da página.
    canvass.height = imaFinal.clientHeight;
  
    const rect = imaFinal.getBoundingClientRect();  // é usada para obter o tamanho e a posição de um elemento em relação a janela do navegador
    const scaleX = imaFinal.width / imaFinal.clientWidth;
    const scaleY = imaFinal.height / imaFinal.clientHeight;
    const posX = (event.clientX - rect.left) * scaleX;
    const posY = (event.clientY - rect.top) * scaleY;
  
    ctxx.drawImage(imaFinal, 0, 0, canvass.width, canvass.height);
    ctxx.beginPath();
    ctxx.arc(posX, posY, 12, 0, 2 * Math.PI);
    ctxx.fillStyle = 'red';
    ctxx.fill();
  
    imaFinal.src = canvass.toDataURL();
    imgFinal64 = canvass.toDataURL();
    document.getElementById(idimg).value = imgFinal64;
}
$('#duster').hide()
$('#caminhonete').hide()
$('#v').on('change',function(){
    if($('#v').val()=="Duster"){
        $('#duster').show()
        $('#caminhonete').remove()
    }if ($('#v').val()=="Caminhonete") {
        $('#caminhonete').show() 
        $('#duster').remove() 
    } 
        
    
})
$(document).ready(function(){
    $("#botao-refresh").click(function(){
        location.reload();
    });
});


