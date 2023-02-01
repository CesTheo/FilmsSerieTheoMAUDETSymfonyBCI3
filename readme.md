
PHP 8.1.11
Composer 2.1.6
Symfony 5.4.21 (Déso)
BDD mysql (j'ai laissé le .env)


SETUP
php bin/console doctrine:database:create

php bin/console make:migration

php bin/console doctrine:migrations:migrate


ROUTE
- "/" Affichage des films
- "/getall" Affiche touts les films
- "/get/{id}" Affiche le film en prennant en compte l'id
- "/create" crée un film via une requete par exemple :
    Format Fetch example pour requete
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({
    "Nom": "Avatar",
    "Synopsis": "Aventure",
    "Type": "Film",
    "Date": "12/04/2021"
    });

    var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
    };

    fetch("http://127.0.0.1:8000/create", requestOptions)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));

