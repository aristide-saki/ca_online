<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CA ONLINE</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>

    <?php require('app/views/components/aside.php'); ?>
    <?php require('app/views/components/header.php'); ?>


    <main>

        <div class="action-btns-container">
            <h3>ENREGISTREMENT CA ONLINE</h3>
            <!-- <button class="button-primary" data-modal="#reservationModal"><span
                    class="material-symbols-outlined">add_circle</span>
                Nouvel enregistrement</button> -->
            <!-- <button class="button-primary" data-modal="#checkInModal"><span
                    class="material-symbols-outlined">add_circle</span>
                Nouvel enregistrement</button> -->
            <!-- <button class="button-secondary" data-modal="#reservationModal"><span
                    class="material-symbols-outlined">timer</span>
                Nouvelle réservation</button> -->
        </div>

        <div class="card-container mt-3" style="max-width: 980px; margin: 20px auto;">

            <div class="flex-sb mb-2">
                <a href="<?= BASE_URL ?>/" class="button button-primary">Nouvel enregistrement</a>
                <!-- <button type="button" class="success">Exporter</button> -->
            </div>
            <hr class="mb-2">


            <form action="" method="post" id="form">

                <!-- <div class="grid"> -->
                <div class="cols-2-r gap-2 justify-sb">

                    <div>
                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="number" name="contact" id="contact" placeholder="Contact">
                        </div>
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="nom" id="nom" placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénoms</label>
                            <input type="text" name="prenom" id="prenom" placeholder="Prénoms">
                        </div>
                        <div class="form-group">
                            <label for="entreprise">Entreprise</label>
                            <input type="text" name="entreprise" id="entreprise" placeholder="Entreprise">
                        </div>
                        <div class="form-group">
                            <label for="zone_intervention">Zone d'intervention</label>
                            <input type="text" name="zone_intervention" id="zone_intervention" placeholder="Zone d'intervention">
                        </div>
                    </div>



                    <div>
                        <div class="form-group">
                            <label for="ticket">Ticket</label>
                            <input type="text" name="ticket" id="ticket" placeholder="Ticket">
                        </div>
                        <div class="form-group">
                            <label for="nd">ND</label>
                            <input type="text" name="nd" id="nd" placeholder="ND">
                        </div>
                        <div class="form-group">
                            <label for="signalisation">Signalisation</label>
                            <!-- <input type="text" name="signalisation" id="signalisation" placeholder="Signalisation"> -->
                            <select name="signalisation" id="signalisation">
                                <option value="">--Choisir--</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="action_corrective">Action corrective</label>
                            <!-- <input type="text" name="action_corrective" id="Action corrective"
                                placeholder="action_corrective"> -->
                            <select name="action_corrective" id="action_corrective">
                                <option value="">--Choisir--</option>

                            </select>
                        </div>
                    </div>

                    <div>

                        <div class="form-group">
                            <label for="statut">Statut</label>
                            <!-- <input type="text" name="statut" id="statut" placeholder="Statut"> -->
                            <select name="statut" id="statut">
                                <option value="">--Choisir--</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="segment">Segment</label>
                            <!-- <input type="text" name="segment" id="segment" placeholder="Segment"> -->
                            <select name="segment" id="segment">
                                <option value="">--Choisir--</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="acteur">Acteur</label>
                            <!-- <input type="text" name="acteur" id="acteur" placeholder="Acteur"> -->
                            <select name="acteur" id="acteur">
                                <option value="">--Choisir--</option>

                            </select>
                        </div>
                    </div>

                </div>





                <div class="cols-2-r gap-2 justify-sb mt-2">

                    <div>
                        <div class="form-group">
                            <label for="date_reception">Date/Heure de réception</label>
                            <input type="datetime-local" name="date_reception" id="date_reception" placeholder="Date/Heure de réception" onchange="calculateTimeDifference()">
                        </div>
                        <div class="form-group">
                            <label for="date_reponse">Date/Heure de réponse</label>
                            <input type="datetime-local" name="date_reponse" id="date_reponse" placeholder="Date/Heure de réponse" onchange="calculateTimeDifference()">
                        </div>
                        <div class="form-group">
                            <label for="temps">Temps</label>
                            <input type="text" name="temps" id="temps" placeholder="Temps">
                        </div>

                    </div>



                    <div>
                        <div class="form-group">
                            <label for="commentaire_1">Commentaire 1</label>
                            <textarea name="commentaire_1" id="commentaire_1" placeholder="Commentaire 1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="commentaire_2">Commentaire 2</label>
                            <!-- <textarea name="commentaire_2" id="commentaire_2" placeholder="Commentaire 2"></textarea> -->
                            <select name="commentaire_2" id="commentaire_2">
                                <option value="">--Choisir--</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noeud_ressource_hs">Noeud ressource HS</label>
                            <input type="text" name="noeud_ressource_hs" id="noeud_ressource_hs" placeholder="Noeud ressource HS">
                        </div>
                        <div class="form-group">
                            <label for="ressource_hs">Ressource HS</label>
                            <input type="text" name="ressource_hs" id="ressource_hs" placeholder="Ressource HS">
                        </div>
                        <div class="form-group">
                            <label for="etat_ressource_hs">Etat ressource HS</label>
                            <input type="text" name="etat_ressource_hs" id="etat_ressource_hs" placeholder="Etat ressource HS">
                        </div>
                        <div class="form-group">
                            <label for="nd_occupant">ND occupant</label>
                            <input type="text" name="nd_occupant" id="nd_occupant" placeholder="ND occupant">
                        </div>

                    </div>

                    <div>
                        <div class="form-group">
                            <label for="agent_ca">Agent CA</label>
                            <input type="text" name="agent_ca" id="agent_ca" placeholder="Agent CA">
                        </div>

                        <div class="flex-a-center gap-2">

                            <button type="button" class="button-success" id="valide">Validé</button>
                            <button type="submit" class="button-primary" id="enregistre">Enregistré</button>

                        </div>
                    </div>

                </div>
                <!-- <div class="col-6"></div> -->
                <!-- </div> -->


            </form>


        </div>



    </main>

    <!-- Modals -->

    <div class="modal" id="saveSuccessModal">
        <div class="modal-content">
            <div class="modal-head">
                <h3>Statut d'enregistrement</h3>
                <span class="material-symbols-outlined close-modal">close</span>
            </div>
            <div class="modal-body">

                <p id="responseMsg"></p>

                <button type="button" class="button-primary mt-2" onclick="dismissModal('#saveSuccessModal')">Ok</button>
            </div>
            <div class="modal-foot">
            </div>
        </div>
    </div>

    <div class="toast">
        <span class="material-symbols-outlined icon">check</span>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident, rerum?</p>
    </div>


    <footer class="mt-2">
        <div class="text-center">
            &copy; 2024 - Tout droit réservé.
        </div>
    </footer>

    <script src="public/js/functions.js"></script>
    <script src="public/js/scripts.js"></script>
    <script src="public/js/selects.js"></script>
    <script>
        // const recap = document.querySelector('.recap');
        // if (localStorage.getItem('recap') === 'reduce') {
        //     recap.classList.add('reduce');
        // }
    </script>
</body>

</html>