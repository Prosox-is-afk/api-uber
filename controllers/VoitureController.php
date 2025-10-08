<?php

require_once "models/VoitureModel.php";

class VoitureController
/**
 * Classe VoitureController
 * 
 * Ce contrôleur gère les opérations liées aux voitures.
 * Il interagit avec le VoitureModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */
{
    private $model;

    public function __construct()
    {
        $this->model = new VoitureModel();
    }

    public function getAllVoitures()
    {
        $voitures = $this->model->getDBAllVoitures();
        echo json_encode($voitures);
    }

    public function getVoitureById($id)
    {
        $voiture = $this->model->getDBVoitureById($id);
        echo json_encode($voiture);
    }
}
// $voitureController = new VoitureController();
// $voitureController->getAllVoitures();