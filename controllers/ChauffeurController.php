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

    public function getChauffeurById($id)
    {
        $chauffeur = $this->model->getDBChauffeurById($id);
        echo json_encode($chauffeur);
    }
    
    public function getVoitureByChauffeurId($id)
    {
        $chauffeur = $this->model->getDBVoitureByChauffeurId($id);
        echo json_encode($chauffeur);
    }

    public function createChauffeur($data)
    {
        $newChauffeurId = $this->model->createDBChauffeur($data);
        if ($newChauffeurId) {
            http_response_code(201); // Ressource créée
            echo json_encode($newChauffeurId);
        } else {
            http_response_code(500); // Erreur interne du serveur
            echo json_encode(["message" => "Error creating chauffeur"]);
        }
    }
}
// $chauffeurController = new ChauffeurController();
// $chauffeurController->getAllChauffeurs();