<?php
require_once "./controllers/ChauffeurController.php";
require_once "./controllers/ClientController.php";
require_once "./controllers/TrajetController.php";
require_once "./controllers/VoitureController.php";

$chauffeurController = new ChauffeurController();
$clientController = new ClientController();
$trajetController = new TrajetController();
$voitureController = new VoitureController();

// Vérifie si le paramètre "page" est vide ou non présent dans l'URL
if (empty($_GET["page"])) {
    // Si le paramètre est vide, on affiche un message d'erreur
    echo "La page n'existe pas";
} else {
    // Sinon, on récupère la valeur du paramètre "page"
    // Par exemple, si l’URL est : index.php?page=chauffeurs/3
    // Alors $_GET["page"] vaut "chauffeurs/3"
    
    // On découpe cette chaîne en segments, en séparant sur le caractère "/"
    // Cela donne un tableau, ex : ["chauffeurs", "3"]
    $url = explode("/", $_GET['page']);
    $method = $_SERVER['REQUEST_METHOD'];
    
    
    // On teste le premier segment pour déterminer la ressource demandée
    switch($url[0]) {
        case "chauffeurs" :
            switch($method) {
                case "GET":
                    // Si un troisème segment est présent, on l’utilise
                    if (isset($url[2]) && $url[2] === "voitures" && isset($url[1])) {
                        // Exemple : /chauffeurs/3/voitures → affiche toutes les voitures du chauffeur 3
                        $chauffeurController->getVoitureByChauffeurId($url[1]);
                    }
                    // Si un second segment est présent (ex: un ID), on l’utilise
                    else if (isset($url[1])) {
                        // Exemple : /chauffeurs/3 → affiche les infos du chauffeur 3
                        $chauffeurController->getChauffeurById($url[1]);
                    } 
                    else {
                        // Sinon, on affiche tous les chauffeurs
                        $chauffeurController->getAllChauffeurs();
                    }
                    break;
                case "POST":
                    $data = json_decode(file_get_contents('php://input'), true);
                    $chauffeurController->createChauffeur($data);
                    break;
                case "PUT":
                    if (isset($url[1])) {
                        $data = json_decode(file_get_contents('php://input'), true);
                        $chauffeurController->updateChauffeur($url[1], $data);
                        echo json_encode($data);
                    } else {
                        echo "L'ID du chauffeur est requis pour la mise à jour.";
                    }
                    break;
                case "DELETE":
                    if (isset($url[1])) {
                        $chauffeurController->deleteChauffeur($url[1]);
                    } else {
                        echo "L'ID du chauffeur est requis pour la suppression.";
                    }
                    break;
            }
            break;
            
        case "clients" :
            switch ($method) {
                case "GET":
                    // Si un second segment est présent (ex: un ID), on l’utilise
                    if (isset($url[1])) {
                        // Exemple : /clients/3 → affiche les infos du client 3
                        $clientController->getClientById($url[1]);
                    } else {
                        // Sinon, on affiche tous les clients
                        $clientController->getAllClients();
                    }
                    break;
                case "POST":
                    $data = json_decode(file_get_contents('php://input'), true);
                    $clientController->createClient($data);
                    break;
                case "PUT":
                    if (isset($url[1])) {
                        $data = json_decode(file_get_contents('php://input'), true);
                        $clientController->updateClient($url[1], $data);
                        echo json_encode($data);
                    } else {
                        echo "L'ID du client est requis pour la mise à jour.";
                    }
                    break;
                case "DELETE":
                    if (isset($url[1])) {
                        $clientController->deleteClient($url[1]);
                    } else {
                        echo "L'ID du client est requis pour la suppression.";
                    }
                    break;
            }
            break;
        case "voitures" : 
            // Si un second segment est présent (ex: un ID), on l’utilise
            if (isset($url[1])) {
                // Exemple : /voitures/3 → affiche les infos du voiture 3
                $voitureController->getVoitureById($url[1]);
            } else {
                // Sinon, on affiche tous les voitures
                $voitureController->getAllVoitures();
            }
            break;

        case "trajets" : 
            // Si un troisième segment est présent, on l’utilise
            if (isset($url[2]) && $url[2] === "details" && isset($url[1]))
            {
                // Exemple : /trajets/3/details → affiche les détails du trajet 3
                $trajetController->getDetailsByTrajetId($url[1]);
            }
            // Si un second segment est présent (ex: un ID), on l’utilise
            else if (isset($url[1])) {
                // Exemple : /trajets/3 → affiche les infos du trajet 3
                $trajetController->getTrajetById($url[1]);
            }
            else {
                // Sinon, on affiche tous les trajets
                $trajetController->getAllTrajets();
            }
            break;
        
        // Si la ressource n'existe pas, on renvoie un message d’erreur
        default :
            echo "La page n'existe pas";
    }
}


?>