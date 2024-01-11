




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
else if (apiOption[0] === 'suppressionUser') {

  console.log("Supression d'un membre")

  fetch("http://127.0.0.1:8080/api/userss/" + apiOption[1], {
    method: 'DELETE',
    headers: {
      'Accept': 'application/ld+json',
      'Content-Type': 'application/json',
    },
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête a échoué.');
    }
    console.log('Suppression réussie.');
  })
  .catch(error => {
    console.error('Erreur lors de la requête DELETE:', error);
  });



}
else if (apiOption[0] === 'ajoutMatchToUser') {

  console.log("Insertion d'un match pour un joueur ")

  //Insertion d'un match lié à un utilisateur avec récupération de l'id de liaison (match_user)
  fetch("http://127.0.0.1:8080/api/match_users", {
    method: 'POST',
    headers: {
      'accept': 'application/ld+json',
      'Content-Type': 'application/ld+json'
    },
    body: JSON.stringify({
      userId: '/api/userss/'+apiOption[1],
      matchId: Number(apiOption[2]),
      win: apiOption[3] === 'true' ? true : false
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête inséré match a échoué.');
    }
    return response.json();
  })
  .then(data => {
    // data contient la réponse JSON de la requête
    apiData = data;
    console.log(apiData)
    console.log("ID inséré :", apiData.id); 
    var lastIdInsert = apiData.id


    //Requête d'insertion dans user_match_stat
    fetch("http://127.0.0.1:8080/api/user_match_stats", {
      method: 'POST',
      headers: {
        'accept': 'application/ld+json',
        'Content-Type': 'application/ld+json'
      },
      body: JSON.stringify({
        userMatch: '/api/match_users/'+lastIdInsert,
        killed: Number(apiOption[4]),
        death:Number(apiOption[5]),
        assist:Number(apiOption[6])
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('La requête inséré match a échoué.');
      }
      return response.json();
    })
    .then(data => {
      // data contient la réponse JSON de la requête
      apiData = data;
      console.log(apiData)
        
    })
    .catch(error => {
      console.error('Erreur lors de la requête:', error);
    });




      
  })
  .catch(error => {
    console.error('Erreur lors de la requête:', error);
  });


}
else if (apiOption[0] === 'createAccount') {

  console.log("Création d'un compte")

  //Insertion d'un match lié à un utilisateur avec récupération de l'id de liaison
  fetch("http://127.0.0.1:8080/api/userss", {
    method: 'POST',
    headers: {
      'Accept': 'application/ld+json',
      'Content-Type': 'application/ld+json',
    },
    body: JSON.stringify({
      "pseudo": apiOption[1],
      "statut": apiOption[2],
      "nbMatch": Number(apiOption[3]),
      "mdp": apiOption[4]
    }),
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('La requête inséré compte a échoué.');
    }
    return response.json();
  })
  .then(data => {
    // data contient la réponse JSON de la requête
    apiData = data;
    console.log(apiData)
    console.log("ID inséré :", apiData.id); // Assurez-vous que la propriété de l'ID est correcte
    // miseEnPlaceVisionnageFicheJoueur(apiData);
  })
  .catch(error => {
    console.error('Erreur lors de la requête:', error);
  });


}
else
{
  console.log("Autre requête")
}