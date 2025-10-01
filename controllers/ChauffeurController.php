<?php

require_once "models/ChauffeurModel.php";

class ChauffeurController
/**
 * Classe ChauffeurController
 * 
 * Ce contrôleur gère les opérations liées aux chauffeurs.
 * Il interagit avec le ChauffeurModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */

{
    private $model;

    public function __construct()
    {
        $this->model = new ChauffeurModel();
    }

    public function getAllChauffeurs()
    {
        $chauffeurs = $this->model->getDBAllChauffeurs();
        echo json_encode($chauffeurs);
    }
}
// $chauffeurController = new ChauffeurController();
// $chauffeurController->getAllChauffeurs();