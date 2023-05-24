<?php
    require_once "../config/config.php";

 
$nom = $prenom = $email = "";
$nom_err = $prenom_err = $email_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $input_nom = trim($_POST["nom"]);
    /* Validation du nom */
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
        $email_err = "Veillez entrez une email.";     
    } else{
        $email = $input_email;
    }
    
    /* verifiez les erreurs avant enregistrement */

    if(empty($nom_err) && empty($prenom_err) && empty($email_err)){

        $query = $pdo->prepare("INSERT INTO blogueur (nom,prenom,email) value (:nom,:prenom,:email)");
        $query->bindParam('nom',$nom);
        $query->bindParam('prenom',$prenom);
        $query->bindParam('email',$email);

        try{
            $query->execute();
            header('location:index.php');
        }
        catch( PDOException $e){
            echo $e;
        }

    }
    
 

    
}

?>
<?php require '../view/createV.php'; ?>