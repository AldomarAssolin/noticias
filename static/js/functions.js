


//Funcao para tabs da pagina de artigo_page
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav_link_autor');
    const cardBodies = document.querySelectorAll('.page');

    navLinks.forEach((link, index) => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            cardBodies.forEach(body => body.style.display = 'none');
            cardBodies[index].style.display = 'block';
        });
    });

    // Initially show the first card body
    cardBodies.forEach((body, index) => body.style.display = index === 0 ? 'block' : 'none');
});

