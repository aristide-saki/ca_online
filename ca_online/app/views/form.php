<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENREGISTREMENT CA ONLINE</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/material-icons.css">
</head>

<body>

    <div class="header">
        <h2>ENREGISTREMENT CA ONLINE</h2>
    </div>
    <div class="container">
        <form action="" id="form" method="post">
            <table>
                <tr class="pb">
                    <td><label for="contact">Contact</label></td>
                    <td><input type="text" name="contact" id="contact"></td>
                    <td class="pl"><label for="ticket">Ticket</label></td>
                    <td><input type="text" name="ticket" id="ticket"></td>
                    <td class="pl"><label for="statut">Statut</label></td>
                    <td>
                        <select name="statut" id="statut">
                            <option value=""></option>
                        </select>
                    </td>
                </tr>

                <tr class="pb">
                    <td><label for="nom">Nom</label></td>
                    <td><input type="text" name="nom" id="nom"></td>
                    <td class="pl"><label for="nd">ND</label></td>
                    <td><input type="text" name="nd" id="nd"></td>
                    <td colspan="2"></td>
                </tr>
                <tr class="pb">
                    <td><label for="prenom">Prénoms</label></td>
                    <td><input type="text" name="prenom" id="prenom"></td>
                    <td class="pl"><label for="signalisation">Signalisation</label></td>
                    <td>
                        <select name="signalisation" id="signalisation">
                            <option value=""></option>
                        </select>
                    </td>
                    <td class="pl"><label for="segment">Segment</label></td>
                    <td>
                        <select name="segment" id="segment">
                            <option value=""></option>
                        </select>
                    </td>
                </tr>
                <tr class="pb">
                    <td><label for="entreprise">Entreprise</label></td>
                    <td><input type="text" name="entreprise" id="entreprise"></td>
                    <td class="pl"><label for="action_corrective">Action corrective</label></td>
                    <td>
                        <select name="action_corrective" id="action_corrective">
                            <option value=""></option>
                        </select>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr class="pb">
                    <td><label for="zone_intervention">Zone d'intervention</label></td>
                    <td><input type="text" name="zone_intervention" id="zone_intervention"></td>
                    <td colspan="2"></td>
                    <td class="pl"><label for="acteur">Acteur</label></td>
                    <td>
                        <select name="acteur" id="acteur">
                            <option value=""></option>
                        </select>
                    </td>
                </tr>
                <tr class="pb">
                    <td colspan="2"></td>
                    <td class="pl"><label for="commentaire_1">Commentaire 1</label></td>
                    <td><textarea name="commentaire_1" id="commentaire_1" rows="5"></textarea></td>
                    <td colspan="2"></td>
                </tr>
                <tr class="pb">
                    <td colspan="2"></td>
                    <td class="pl"><label for="commentaire_2">Commentaire 2</label></td>
                    <td>
                        <select name="commentaire_2" id="commentaire_2">
                            <option value=""></option>
                        </select>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td><label for="date_reception">Date/heure de réception</label></td>
                    <td><input type="datetime-local" name="date_reception" id="date_reception" onchange="calculateTimeDifference()"></td>
                    <td class="pl"><label for="noeud_ressource_hs">Noeud Ressource HS</label></td>
                    <td><input type="text" name="noeud_ressource_hs" id="noeud_ressource_hs"></td>
                    <td class="pl"><label for="agent_ca">Agent CA</label></td>
                    <td><input type="text" name="agent_ca" id="agent_ca"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="pl"><label for="ressource_hs">Ressource HS</label></td>
                    <td><input type="text" name="ressource_hs" id="ressource_hs"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td><label for="date_reponse">Date/heure de réponse</label></td>
                    <td><input type="datetime-local" name="date_reponse" id="date_reponse" onchange="calculateTimeDifference()"></td>
                    <td class="pl"><label for="etat_ressource_hs">Etat ress. HS</label></td>
                    <td><input type="text" name="etat_ressource_hs" id="etat_ressource_hs"></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td class="pl"><label for="nd_occupant">ND occupant</label></td>
                    <td><input type="text" name="nd_occupant" id="nd_occupant"></td>
                    <td class="center pl" colspan="2">
                        <button type="button" class="button-success" id="valide">Validé</button>
                    </td>
                </tr>
                <tr>
                    <td><label for="temps">Temps</label></td>
                    <td><input type="text" name="temps" id="temps"></td>
                    <td colspan="2"></td>
                    <td class="center pl" colspan="2"><button type="submit" class="button-primary" id="enregistre">Enregistré</button></td>
                </tr>
            </table>
        </form>
    </div>

    <a href="<?= BASE_URL ?>/enregistrements" class="floting-btn"><i class="material-symbols-outlined">description</i><span>Enregistrements</span></a>

    <script src="<?= BASE_URL ?>/public/js/functions.js"></script>
    <script src="<?= BASE_URL ?>/public/js/scripts.js"></script>
    <script src="<?= BASE_URL ?>/public/js/selects.js"></script>

</body>

</html>