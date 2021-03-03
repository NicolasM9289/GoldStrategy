//Vérification du formulaire de login côté client puis côté serveur en AJAX

function login(event){
    // Evite le comportement normal du formulaire car on passe par l'ajax
    event.preventDefault();

    let form = document.getElementById("login-form");
    let isFormValid = validate(form);

    // Si le formulaire est valide côté client, envoi pour validation au serveur
    if (isFormValid){
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        let data = new URLSearchParams({
            'email': email,
            'pass': password
        });

        fetch('connect.php', {
            method: 'POST', 
            body: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
            }
        })
        .then(response => response.text())
        .then(serverResponse => {

            switch (serverResponse) {
                case 'Success':
                    window.location.href = "index.php";
                    break;

                case 'Invalid email':
                    document.getElementById('email').nextElementSibling.innerHTML = "Adresse email incorrecte";
                    document.getElementById('email').parentElement.classList.add('input-error');
                    break;

                case 'Invalid password':
                    document.getElementById('password').nextElementSibling.innerHTML = "Mot de passe incorrect";
                    document.getElementById('password').parentElement.classList.add('input-error');
                    break;
            }
        })
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
    if( form.email.value == "" ) {
        form.email.nextElementSibling.innerHTML = "Veuillez remplir ce champ";
        form.email.parentElement.classList.add('input-error');
        isValid = false;
    }

    if( form.password.value == "" ) {
        form.password.nextElementSibling.innerHTML = "Veuillez remplir ce champ";
        form.password.parentElement.classList.add('input-error');
        isValid = false;
    }

    //On vérifie le format de l'email
    let email_format = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(form.email.value && !form.email.value.match(email_format)){
        form.email.nextElementSibling.innerHTML = "Format de l'adresse email invalide";
        form.email.parentElement.classList.add('input-error');
        isValid = false;
    }

    return isValid;
}

// Evenement qui se déclenche à l'appui du bouton de connexion
document.getElementById("submit").addEventListener("click", login);