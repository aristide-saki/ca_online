<?php

// namespace App\Models;

class Caoline
{

    private $db;

    public function __construct()
    {
        require_once 'Database.php';

        // Instancier la classe Database
        $dbase = new Database();
        $this->db = $dbase->getConnection();

        // Vérifier la connexion à la base de données
        if ($this->db === null) {
            die("Database connection failed.");
        }
    }



    /**
     * Create CA ONMINE
     */
    public function insert($data)
    {
        extract($data);
        $now = date('Y-m-d H:i:s');

        // Vérifier si le numéro existe déjà
        if ($this->getOne($contact)) {
            return $this->update($data);
        } else {

            $sql = "INSERT INTO ca_online (contact, nom, prenom, entreprise, zone_intervention, ticket, nd, signalisation, action_corrective, statut, segment, acteur, date_reception, date_reponse, temps, commentaire_1, commentaire_2, noeud_ressource_hs, ressource_hs, etat_ressource_hs, nd_occupant, agent_ca, date_enregistrement) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $req = $this->db->prepare($sql);
            $result = $req->execute([$contact, $nom, $prenom, $entreprise, $zone_intervention, $ticket, $nd, $signalisation, $action_corrective, $statut, $segment, $acteur, $date_reception, $date_reponse, $temps, $commentaire_1, $commentaire_2, $noeud_ressource_hs, $ressource_hs, $etat_ressource_hs, $nd_occupant, $agent_ca, $now]);
            return $result;
        }
    }

    /**
     * Create CA ONMINE
     */
    public function update($data)
    {
        extract($data);

        $sql = "UPDATE ca_online SET contact=?, nom=?, prenom=?, entreprise=?, zone_intervention=?, ticket=?, nd=?, signalisation=?, action_corrective=?, statut=?, segment=?, acteur=?, date_reception=?, date_reponse=?, temps=?, commentaire_1=?, commentaire_2=?, noeud_ressource_hs=?, ressource_hs=?, etat_ressource_hs=?, nd_occupant=?, agent_ca=? WHERE contact=?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([$contact, $nom, $prenom, $entreprise, $zone_intervention, $ticket, $nd, $signalisation, $action_corrective, $statut, $segment, $acteur, $date_reception, $date_reponse, $temps, $commentaire_1, $commentaire_2, $noeud_ressource_hs, $ressource_hs, $etat_ressource_hs, $nd_occupant, $agent_ca, $contact]);
        return $result;
    }



    // Select 

    public function getAll()
    {

        $sql = "SELECT * FROM ca_online WHERE active=? ORDER BY id DESC";
        $req = $this->db->prepare($sql);
        $req->execute([1]);
        $result = $req->fetchAll();
        return $result;
    }
    // Select One 

    public function getOne($contact)
    {

        $sql = "SELECT * FROM ca_online WHERE active=? AND (contact LIKE ? OR id = ?) ORDER BY id DESC";
        $req = $this->db->prepare($sql);
        $req->execute([1, $contact, $contact]);
        $result = $req->fetch();
        return $result;
    }



    public function delete($id)
    {

        $sql = "UPDATE ca_online SET active = ? WHERE id = ?";
        $req = $this->db->prepare($sql);
        $result = $req->execute([0, $id]);
        return $result;
    }




    // 
}
