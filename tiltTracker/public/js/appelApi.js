




var scriptTag = document.currentScript;
var apiOption = scriptTag.getAttribute('data-api-option').split(",");

console.log(apiOption);

if (apiOption[0] === 'getListe') { //Récupération de la liste de tous les joueurs


  console.log("Affichage de la liste des joueurs")
  var apiData;

  fetch("http://127.0.0.1:8080/api/userss")
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête a échoué.');
    }
    return response.json();
  })
  .then(data => {
    apiData = data["hydra:member"];
    miseEnPlaceListeJoueur(apiData); //Dès que les données sont récupérées, elles sont renvoyé à la page principale
  })
  .catch(error => {
    console.error('Erreur lors de la requête:', error);
  });

   
}
else if (apiOption[0] === 'getSpecificAccount') //Récupération d'une fiche joueurs
{

  console.log("Affichage d'une fiche utilisateur")
  var apiData;

  fetch("http://127.0.0.1:8080/api/userss/"+ apiOption[1])
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête a échoué.');
    }
    return response.json();
  })
  .then(data => {
    apiData = data
    console.log(apiData)
    miseEnPlaceVisionnageFicheJoueur(apiData); //Dès que les données sont récupérées, elles sont renvoyé à la page principale
  })
  .catch(error => {
    console.error('Erreur lors de la requête:', error);
  });

}
else if (apiOption[0] === 'updateStatut') {

  console.log("Mise à jour du statut de la fiche")
  var apiData;
  var newStatut;

  var statut = apiOption[2];

  if(statut == "public")
  {
    newStatut = "privé"
  }
  else
  {
    newStatut = "public"
  }

  fetch("http://127.0.0.1:8080/api/userss/" + apiOption[1], {
    method: 'PATCH',
    headers: {
      'Accept': 'application/ld+json',
      'Content-Type': 'application/merge-patch+json',
    },
    body: JSON.stringify({
      "statut": newStatut
    }),
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('La requête a échoué.');
      }
      return response.json();
    })
    .then(data => {
      apiData = data;
      console.log(apiData);
      miseEnPlaceVisionnageFicheJoueur(apiData);
    })
    .catch(error => {
      console.error('Erreur lors de la requête:', error);
    });

}
else
{
  console.log("Autre requête")
}