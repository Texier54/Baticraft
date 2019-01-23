<input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
<input type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
<input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
<input type="button" value="Lien" onclick="commande('createLink');" />
<input type="button" value="Image" onclick="commande('insertImage');" />
<select onchange="commande('heading', this.value); this.selectedIndex = 0;">
  <option value="">Titre</option>
  <option value="h1">Titre 1</option>
  <option value="h2">Titre 2</option>
  <option value="h3">Titre 3</option>
  <option value="h4">Titre 4</option>
  <option value="h5">Titre 5</option>
  <option value="h6">Titre 6</option>
</select>
<div id="editeur" contentEditable></div>
<input type="button" onclick="resultat();" value="Obtenir le HTML" />
<br />
<textarea id="resultat"></textarea>


<style>

#editeur,
textarea {
  width: 500px;
  height: 200px;
  border: 1px solid black;
  padding: 5px;
  overflow: auto;
}

</style>

<script>
function commande(nom, argument) {
  if (typeof argument === 'undefined') {
    argument = '';
  }
  switch (nom) {
    case "createLink":
      argument = prompt("Quelle est l'adresse du lien ?");
      break;
    case "insertImage":
      argument = prompt("Quelle est l'adresse de l'image ?");
      break;
  }
  // Exécuter la commande
  document.execCommand(nom, false, argument);
}

function resultat() {
  document.getElementById("resultat").value = document.getElementById("editeur").innerHTML;
}

</script>