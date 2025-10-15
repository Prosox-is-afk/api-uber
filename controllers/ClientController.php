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

    public function createClient($data)
    {
        $newClientId = $this->model->createDBClient($data);
        if ($newClientId) {
            http_response_code(201); // Ressource créée
            echo json_encode($newClientId);
        } else {
            http_response_code(500); // Erreur interne du serveur
            echo json_encode(["message" => "Error creating client"]);
        }
    }
}
// $clientController = new ClientController();
// $clientController->getAllClients();