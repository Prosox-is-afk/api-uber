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
        $stmt ->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDBVoitureByChauffeurId($id)
    {
        $sql = "SELECT * FROM `voiture` WHERE chauffeur_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createDBChauffeur($data)
    {
        $sql = "INSERT INTO chauffeur (chauffeur_id, chauffeur_nom, chauffeur_telephone) VALUES (:chauffeur_id, :chauffeur_nom, :chauffeur_telephone)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':chauffeur_id', $data['chauffeur_id'], PDO::PARAM_INT);
        $stmt->bindParam(':chauffeur_nom', $data['chauffeur_nom'], PDO::PARAM_STR);
        $stmt->bindParam(':chauffeur_telephone', $data['chauffeur_telephone'], PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->getDBChauffeurById($data['chauffeur_id']);
    }

    public function updateDBChauffeur($id, $data)
    {
        $sql = "UPDATE chauffeur SET chauffeur_id = :chauffeur_id, chauffeur_nom = :chauffeur_nom, chauffeur_telephone = :chauffeur_telephone WHERE chauffeur_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':chauffeur_id', $data['chauffeur_id'], PDO::PARAM_INT);
        $stmt->bindParam(':chauffeur_nom', $data['chauffeur_nom'], PDO::PARAM_STR);
        $stmt->bindParam(':chauffeur_telephone', $data['chauffeur_telephone'], PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Vérifie si une ligne a été modifiée
        return $stmt->rowCount() > 0;
    }
}

// $chauffeurs = new ChauffeurModel();
// print_r($chauffeurs->getDBAllChauffeurs());
