<?php

require_once "models/ClientModel.php";

class ClientController
/**
 * Classe ClientController
 * 
 * Ce contrôleur gère les opérations liées aux clients.
 * Il interagit avec le ClientModel pour récupérer les données
 * et retourne les résultats au format JSON.
 */
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function getAllClients()
    {
        $clients = $this->model->getDBAllClients();
        echo json_encode($clients);
    }

    public function getClientById($id)
    {
        $client = $this->model->getDBClientById($id);
        echo json_encode($client);
    }
}
// $clientController = new ClientController();
// $clientController->getAllClients();