<?php

class ClientModel
/**
 * Classe ClientModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les clients.
 * Il interagit avec le base de données pour récupérer les données
 * et retourne les résultats au controller.
 */
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=pierre-uber;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getDBAllClients()
    {
        $stmt = $this->pdo->query("SELECT * FROM Client");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBClientById($id)
    {
        $sql = "SELECT * FROM Client WHERE client_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createDBClient($data)
    {
        $sql = "INSERT INTO client (client_id, client_nom, client_telephone) VALUES (:client_id, :client_nom, :client_telephone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':client_id', $data['client_id'], PDO::PARAM_INT);
        $stmt->bindParam(':client_nom', $data['client_nom'], PDO::PARAM_STR);
        $stmt->bindParam(':client_telephone', $data['client_telephone'], PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->getDBClientById($data['client_id']);
    }

    public function updateDBClient($id, $data)
    {
        $sql = "UPDATE client SET client_id = :client_id, client_nom = :client_nom, client_telephone = :client_telephone WHERE client_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':client_id', $data['client_id'], PDO::PARAM_STR);
        $stmt->bindParam(':client_nom', $data['client_nom'], PDO::PARAM_STR);
        $stmt->bindParam(':client_telephone', $data['client_telephone'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->getDBClientById($id);
    }

    public function deleteDBClient($id)
    {
        $sql = "DELETE FROM client WHERE client_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

// $clients = new ClientModel();
// print_r($clients->getDBAllClients());
