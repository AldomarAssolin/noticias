
var divRoot = document.getElementById("root");
var myHeaders = new Headers();

var myInit = {
    method: "GET",
    headers: myHeaders,
    mode: "cors",
    cache: "default",
};

var myRequest = new Request("https://servicodados.ibge.gov.br/api/v3/noticias/?qtd=5", myInit);

fetch(myRequest)
    .then(function(response){
        if(!response.ok){
            throw new Error("Prblema na resposta: " + response.statusText);
        }

        return response.json();
    })
    .then(function (data){
        console.log(data);
        //divRoot.innerHTML = JSON.stringify(data, null, 2);
    })
    .catch(function(error){
        console.error('Houve um problema com a requisição: ', error);
    })

function card(){

}