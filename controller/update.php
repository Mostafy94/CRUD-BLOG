<?php
/* Inclure le fichier */
require_once "../config/config.php";

 
/* Definir les variables */
$nom = $prenom = $email = "";
$nom_err = $ecole_err = $age_err = "";
 
/* verifier la valeur id dans le post pour la mise à jour */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* recuperation du champ caché */
    $id = $_POST["id"];
    
    /* Validation du nom */
    $input_nom = trim($_POST["nom"]);
    if(empty($input_nom)){
        $nom_err = "Veillez entrez un nom.";
    } elseif(!filter_var($input_nom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nom_err = "Veillez entrez un nom valide.";
    } else{
        $nom = $input_nom;
    }
    
    /* Validation du prenom */
    $input_prenom = trim($_POST["prenom"]);
    if(empty($input_prenom)){
        $prenom_err = "Veillez entrez un prenom.";
    } elseif(!filter_var($input_prenom, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $prenom_err = "Veillez entrez un prenom valide.";
    } else{
        $prenom = $input_prenom;
    }
    
    /* Validation du email */
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Veillez entrez un email.";     
    } else{
        $email = $input_email;
    }
    
    /* verifier les erreurs avant modification */
    if(empty($nom_err) && empty($prenom_err) && empty($email_err)){
        
        $sql = "UPDATE blogueur SET nom=:nom, prenom=:prenom, email=:email WHERE id=:id";
        
        $query = $pdo->prepare($sql);
        $query->bindParam('id',$id);
        $query->bindParam('nom',$nom);
        $query->bindParam('prenom',$prenom);
        $query->bindParam('email',$email);

        try{
            $query->execute();
            header('location:../controller/index.php');
        }
        catch( PDOException $e){
            echo $e;
        }
    }
} else{
    /* si il existe un paramettre id */
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
       
        $sql = "SELECT * FROM blogueur WHERE id = :id";

        $query = $pdo->prepare($sql);
        $query->bindParam('id',$id);
        $query->bindParam('nom',$nom);
        $query->bindParam('prenom',$prenom);
        $query->bindParam('email',$email);
    }else{
        /* pas de id parametter valid, retourne erreur */
        header("location: ../view/error.php");
        exit();
    }
}
?>
 
<?php require '../view/updateV.php'; ?>