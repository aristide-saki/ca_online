<?php

include_once '../../includes/__init__.php';
include_once '../models/Format.php';
include_once '../models/Caoline.php';


$model = new Caoline();
$data = $model->getAll();

if ($data) {
?>
    <div class="flex-j-end mt-2">
        <button type="button" class="success" onclick="telechargerTableau();">
            <span class="material-symbols-outlined ">download</span>
            <span>Exporter</span>
        </button>
    </div>
    <div class="table-responsive">
        <table id="tableau" class="mt-2">
            <thead>
                <tr>
                    <th>Contact</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Entreprise</th>
                    <th>Zone d'intervention</th>
                    <th>Ticket</th>
                    <th>ND</th>
                    <th>Signalisation</th>
                    <th>Action corrective</th>
                    <th>Statut</th>
                    <th>Segment</th>
                    <th>Acteur</th>
                    <th>Date/Heure de réception</th>
                    <th>Date/Heure de réponse</th>
                    <th>Temps</th>
                    <th>Commentaire 1</th>
                    <th>Commentaire 2</th>
                    <th>Noeud ressource HS</th>
                    <th>Ressource HS</th>
                    <th>Etat ressource HS</th>
                    <th>ND occupant</th>
                    <th>Agent CA</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $row['contact']; ?></td>
                        <td><?= $row['nom']; ?></td>
                        <td><?= $row['prenom']; ?></td>
                        <td><?= $row['entreprise']; ?></td>
                        <td><?= $row['zone_intervention']; ?></td>
                        <td><?= $row['ticket']; ?></td>
                        <td><?= $row['nd']; ?></td>
                        <td><?= $row['signalisation']; ?></td>
                        <td><?= $row['action_corrective']; ?></td>
                        <td><?= $row['statut']; ?></td>
                        <td><?= $row['segment']; ?></td>
                        <td><?= $row['acteur']; ?></td>
                        <td><?= dateFormat($row['date_reception']) . ' ' . heureFormat($row['date_reception']); ?></td>
                        <td><?= dateFormat($row['date_reponse']) . ' ' . heureFormat($row['date_reponse']); ?></td>
                        <td><?= $row['temps']; ?></td>
                        <td><?= $row['commentaire_1']; ?></td>
                        <td><?= $row['commentaire_2']; ?></td>
                        <td><?= $row['noeud_ressource_hs']; ?></td>
                        <td><?= $row['ressource_hs']; ?></td>
                        <td><?= $row['etat_ressource_hs']; ?></td>
                        <td><?= $row['nd_occupant']; ?></td>
                        <td><?= $row['agent_ca']; ?></td>
                        <td>
                            <div class="flex-a-center gap-1">
                                <a href="<?= BASE_URL; ?>/?q=<?= $row['id']; ?>" style="display:none;"><span class="material-symbols-outlined icon-btn success">edit</span></a>
                                <span class="material-symbols-outlined icon-btn danger" onclick="confirmDelete(<?= $row['id']; ?>)">delete</span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php } else {
    echo '<p class="mt-2">Aucun enregistrement.</p>';
} ?>