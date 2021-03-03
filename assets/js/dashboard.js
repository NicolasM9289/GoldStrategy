//Vérification du formulaire de login côté client puis côté serveur en AJAX

function generatePDF(event){
    // Evite le comportement normal du formulaire car on passe par l'ajax
    event.preventDefault();

    let form = document.getElementById("pdf-form");
    let isFormValid = validate(form);

    //Si le formulaire est valide, téléchargement du fichier PDF
    if (isFormValid){
        var title = document.getElementById('title').value;
        var comment = document.getElementById('comment').value;

        var request = new XMLHttpRequest();
        request.open('POST', 'pdf.php', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        request.responseType = 'blob';

        request.onload = function() {

            if(request.status === 200) {
                // On récupère le nom du fichier
                var disposition = request.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'file.pdf');

                // Téléchargement du fichier chez le client
                var blob = new Blob([request.response], { type: 'application/pdf' });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;

                document.body.appendChild(link);

                link.click();

                document.body.removeChild(link);
            }

        };

        request.send('title=' + title + '&comment=' + comment);
    }
}


// Vérification du formulaire côté client
function validate(form) {

    let isValid = true;

    //Réinitalisation des erreurs avant (re)vérification
    let groups = document.querySelectorAll(".form-group");
    for (let group of groups){
        group.classList.remove('input-error');
    }

    // On vérifie si un des champs est vide
    if( form.title.value == "" ) {
        form.title.nextElementSibling.innerHTML = "Veuillez remplir ce champ";
        form.title.parentElement.classList.add('input-error');
        isValid = false;
    }

    if( form.comment.value == "" ) {
        form.comment.nextElementSibling.innerHTML = "Veuillez remplir ce champ";
        form.comment.parentElement.classList.add('input-error');
        isValid = false;
    }

    return isValid;
}

// Evenement qui se déclenche à l'appui du bouton de connexion
document.getElementById("submit").addEventListener("click", generatePDF);


