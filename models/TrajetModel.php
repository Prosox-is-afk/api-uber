<?php

class TrajetModel
/**
 * Classe TrajetModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les trajets.
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

    public function getDBAllTrajets()
    {
        $stmt = $this->pdo->query("SELECT * FROM trajet");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBTrajetById($id)
    {
        $sql = "SELECT * FROM trajet WHERE trajet_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

// $trajets = new TrajetModel();
// print_r($trajets->getDBAllTrajets());
