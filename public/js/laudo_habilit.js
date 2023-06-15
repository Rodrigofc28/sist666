
const imaFinal = document.getElementById('imgFinal');
imaFinal.onload=function(){
const canvass = document.createElement('canvas');
const ctxx = canvass.getContext('2d');
canvass.width = imaFinal.width;
canvass.height = imaFinal.height;

function adicionarCirculoFinal(event) {
  // Pega a posição do clique do mouse em relação à imagem
  const posX = event.offsetX;
  const posY = event.offsetY;

  // Desenha a imagem original no canvas
  ctxx.drawImage(imaFinal, 0, 0);

  // Desenha o círculo no canvas
  ctxx.beginPath();
  ctxx.arc(posX, posY, 18, 0, 2 * Math.PI); // 6 altera o tamanho do circulo
  ctxx.fillStyle = 'red';
  ctxx.fill();

  // Atualiza a imagem com o conteúdo do canvas
  imaFinal.src = canvass.toDataURL();
  imgFinal64= canvass.toDataURL();
  document.getElementById('imagemFinal_base64').value = imgFinal64;
}

imaFinal.addEventListener('click', adicionarCirculoFinal);}

const imagem = document.getElementById('ima');

imagem.onload = function() {    

const canvas = document.createElement('canvas');
const ctx = canvas.getContext('2d');
canvas.width = imagem.width;
canvas.height = imagem.height;

function adicionarCirculo(event) {
  // Pega a posição do clique do mouse em relação à imagem
  const posX = event.offsetX;
  const posY = event.offsetY;

  // Desenha a imagem original no canvas
  ctx.drawImage(imagem, 0, 0);

  // Desenha o círculo no canvas
  ctx.beginPath();
  ctx.arc(posX, posY, 18, 0, 2 * Math.PI); // 6 altera o tamanho do circulo
  ctx.fillStyle = 'red';
  ctx.fill();

  // Atualiza a imagem com o conteúdo do canvas
  imagem.src = canvas.toDataURL();
  imgInicio64= canvas.toDataURL();
  document.getElementById('imagem_base64').value = imgInicio64;

    // Submete o formulário para o controller
    
}

imagem.addEventListener('click', adicionarCirculo);}

var array=[];
$('#incluir').on('click',function(){
   $i=0 
   var nome=$('#nome_vitima').val()
    var perfil=$('#perfil_envolvido').val()
    if(nome==''){
        alert("preencha o campo nome do envolvido")
    }
    if(perfil==''){
        alert("preencha o campo perfil")
    }
    if(nome!='' && perfil!=''){
        alert("nome adicionado")
        
        
        
        array.push(nome)
        array.push(perfil)
        
        console.log(array)
        $('#nome_vitima').val('')
        $('#perfil_envolvido').val('')
        $('#nomeIncluir').val(array)
        
        //alert(`Incluidos: ${array}`)
    }
   
    
})


//busca cep em desenvolvimento
$('#buttoncep').on('click',function(e){
     e.preventDefault();
    let cep=$('#cep').val();
    
    let url=`http://viacep.com.br/ws/${cep}/json/`;
    fetch(url).then(function(response){
        
        response.json().then(function(data){
            
            var ler=data.localidade
            
            console.log(data)
            $('#complemento').text(data.complemento)
            $('#rua').text(data.logradouro)
            $('#bairro').val(data.bairro)
            $('#cidade').val(ler); // Select the option with a value of '1'
            $('#cidade').trigger('change');
            
            
          
            

            
        })
    })  
    

});



