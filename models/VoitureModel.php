<?php

class VoitureModel
/**
 * Classe VoitureModel
 * 
 * Ce modèle s'occupe de récupérer les données sur les voitures.
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

    public function getDBAllVoitures()
    {
        $stmt = $this->pdo->query("SELECT * FROM Voiture");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $voitures = new VoitureModel();
// print_r($voitures->getDBAllVoitures());
