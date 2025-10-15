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

    public function updateClient($id, $data)
    {
        $success = $this->model->updateDBClient($id, $data);
        if ($success) {
            http_response_code(204); // OK
        } else {
            http_response_code(404); // Erreur : non trouvé
            echo json_encode(["message" => "Client non trouvé ou non modifié"]);
        }
    }

    public function deleteClient($id)
    {
        $success = $this->model->deleteDBClient($id);
        if ($success) {
            http_response_code(204); // OK
        } else {
            http_response_code(404); // Erreur : non trouvé
            echo json_encode(["message" => "Client introuvable"]);
        }
    }
}
// $clientController = new ClientController();
// $clientController->getAllClients();