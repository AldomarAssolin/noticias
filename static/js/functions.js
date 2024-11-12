//atualiza a pagina sem recarregar
function atualizaPagina(){
    location.reload();
}

//atualizaPagina();


//atribuindo URL às imagens do editor.
function getImgUrl(){
    const images = document.querySelectorAll('.conteudo img');
    images.forEach(img => {
        const attr = img.getAttribute('src');
        img.setAttribute('src', 'painel/' + attr);
    });
}

window.onload = getImgUrl;

