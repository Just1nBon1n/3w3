/****************************************
  Gestion du catalogue (tri/filtre, etc.)
****************************************/

// TRI
// Saisie le SELECT qui permet le tri
let selectTri = document.querySelector('select#tri');

// S'il existe, lui associer un écouteur d'événement pour detecter le changement de valeur
if (selectTri) {
  selectTri.addEventListener("change", gererTriSynchrone);
}

function gererTriSynchrone(evt) {
  console.log("La valeur de tri a changé : ", evt.target.value);
  console.log("Le form qui contient le SELECT : ", evt.target.closest("form"));
  console.log("Le form qui contient le SELECT (raccourci) : ", evt.target.form);
  // Sasir le formulaire associé au SELECT ...
  let leFrm = evt.target.form;

  // ... et le soumettre
  leFrm.submit();
}
// FIN TRI