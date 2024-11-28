
//atualiza a pagina sem recarregar
// function atualizaPagina() {
//     location.reload();
// }

function atualizaPagina() {
    fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
            document.open();
            document.write(html);
            document.close();
        })
        .catch(err => console.warn('Something went wrong.', err));
}

//atribuindo URL às imagens do editor.
function getImgUrl() {
    const images = document.querySelectorAll('.conteudo img');
    images.forEach(img => {
        const attr = img.getAttribute('src');
        img.setAttribute('src', 'painel/' + attr);
    });
}

window.onload = getImgUrl;


// Save scroll position before unloading the page
window.addEventListener('beforeunload', () => {
    localStorage.setItem('scrollPosition', window.scrollY);
});

// Restore scroll position after loading the page
window.addEventListener('load', () => {
    const scrollPosition = localStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition, 10));
    }
});

//



