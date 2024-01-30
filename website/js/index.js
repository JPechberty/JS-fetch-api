console.log("index.js loaded")


fetch('../json/content.json')
    .then(function (response) {
        console.log(response);
        return response.json();
    })
    .then(function (data) {
        console.log(data);
        const contentGrid = document.querySelector('#content-grid');
        data.forEach(obj=>buildCard(obj, contentGrid))
        document.querySelector('#info-alert').classList.add('d-none');
        document.querySelector('#content-grid').classList.remove('d-none');
        console.log("request succeeded");
    })
    .catch(function (error) {
        console.error(error);
        document.querySelector('#info-alert').classList.add('d-none');
        document.querySelector('#error-alert').classList.remove('d-none');
    });


function buildCard(obj, containerElement){
    const template = document.querySelector('#content-card-template');
    const clone = template.content.cloneNode(true);
    clone.querySelector(".card-title").textContent = obj.title;
    clone.querySelector(".card-text").textContent = obj.content;
    clone.querySelector(".stretched-link").href = obj.link;
    containerElement.append(clone);
}