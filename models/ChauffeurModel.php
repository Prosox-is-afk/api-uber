<?php

class ChauffeurModel
/**
 * Classe ChauffeurModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les chauffeurs.
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

    public function getDBAllChauffeurs()
    {
        $sql = "SELECT * FROM Chauffeur";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBChauffeurById($id)
    {
        $sql = "SELECT * FROM Chauffeur WHERE chauffeur_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDBVoitureByChauffeurId($id)
    {
        $sql = "SELECT * FROM `voiture` WHERE chauffeur_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $chauffeurs = new ChauffeurModel();
// print_r($chauffeurs->getDBAllChauffeurs());
