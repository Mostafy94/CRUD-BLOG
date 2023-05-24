<?php
/* Verifiez si le paramettre id existe */
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "../config/config.php";

    /* Preparer la requete */
    $sql = "SELECT * FROM blogueur WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindParam('id',$_GET['id']);
    try{
        $query->execute();
        header('location:../controller/index.php');
    }
    catch(PDOException $e){
        echo $e;
    }
} else {
    /* Si pas de id correct retourne la page d'erreur */
    header("location: ../view/error.php");
    exit();
}
?>
<?php require '../view/readV.php'; ?>