




var scriptTag = document.currentScript;
var apiOption = scriptTag.getAttribute('data-api-option').split(",");

console.log(apiOption);

if (apiOption[0] === 'getListe') { //Récupération de la liste de tous les joueurs --- apiOption : [0]:type de vérification


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
else if (apiOption[0] === 'getSpecificAccount') //Récupération d'une fiche user --- apiOption : [0]:type de vérification - [1]: idUser
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
else if (apiOption[0] === 'updateStatut') { //Changement du statut d'un user --- apiOption : [0]:type de vérification - [1]: idUser - [2]: statut actuel du user

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
else if (apiOption[0] === 'verificationConnexion') { // système de vérirification des identifiant de connexion d'un user --- apiOption : [0]:type de vérification - [1]: pseudo - [2]: motDePasse 


  console.log("Vérification de la connexion")
  var apiData;
  var newStatut;

  var pseudo = apiOption[1];
  let pseudoModifie = pseudo.replace(/ /g, "%20");
  var motDePasse = apiOption[2];

  console.log("pseudoModifie : " + pseudoModifie + "motDePasse : " + motDePasse)


  fetch("http://127.0.0.1:8080/api/userss?pseudo="+pseudoModifie+"&motDePasse="+motDePasse)
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête a échoué.');
    }
    return response.json();
  })
  .then(data => {
    apiData = data
    gestionEtatConnexion(apiData); //Dès que les données sont récupérées, elles sont renvoyé à la page principale
  })
  .catch(error => {
    console.error('Erreur lors de la requête:', error);
  });
  

}
else if (apiOption[0] === 'rechercheUser') { // système de recherche de user --- apiOption : [0]:type de vérification - [1]: recherche


  console.log("Recherche utilisateur - Désactivé")
  // var apiData;
  // var newStatut;

  // var recherche = apiOption[1];
  // // var rechercheModifie = recherche.replace(/ /g, "%20");


  // console.log("http://127.0.0.1:8080/api/userss?pseudo="+recherche)

  // fetch("http://127.0.0.1:8080/api/userss?pseudo="+recherche )
  // .then(response => {
  //   if (!response.ok) {
  //     throw new Error('La requête a échoué.');
  //   }
  //   return response.json();
  // })
  // .then(data => {
  //   apiData = data
  //   resultatRechercheGenerale(apiData); //Dès que les données sont récupérées, elles sont renvoyé à la page principale
  // })
  // .catch(error => {
  //   console.error('Erreur lors de la requête:', error);
  // });
  

}
else
{
  console.log("Autre requête")
}