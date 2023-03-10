const textArea = document.querySelector("div.container");
const resultContainer = document.querySelector("div#result");

function Submit(q) {

    fetch("fetch.php?q=" + q).then( response => {
        response.text().then( text => {
            resultContainer.innerText = text;
        });
    });

}