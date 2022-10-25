$('#nao_deflagrado').on('click', function () {
    console.log('sdsds');
    if($('#lacrecartucho').attr('disabled')){
    $('#lacrecartucho').attr('disabled', false);}
    else{
        $('#lacrecartucho').attr('disabled', true);
    }
    
});