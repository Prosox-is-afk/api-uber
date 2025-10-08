<?php

require_once "models/TrajetModel.php";

class TrajetController
/**
 * Classe TrajetController
 * 
 * Ce contrôleur gère les opérations liées aux trajets.
 * Il interagit avec le TrajetModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */
{
    private $model;

    public function __construct()
    {
        $this->model = new TrajetModel();
    }

    public function getAllTrajets()
    {
        $trajets = $this->model->getDBAllTrajets();
        echo json_encode($trajets);
    }

    public function getTrajetById($id)
    {
        $trajet = $this->model->getDBTrajetById($id);
        echo json_encode($trajet);
    }
    
    public function getDetailsByTrajetId($trajet_id)
    {
        $details = $this->model->getDBDetailsByTrajetId($trajet_id);
        echo json_encode($details);
    }
}
// $trajetController = new TrajetController();
// $trajetController->getAllTrajets();