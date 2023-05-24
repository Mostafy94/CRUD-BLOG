<?php
/* confirmer */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* Inclure le fichier config */
    require_once "../config/config.php";


    $id = $_POST['id'];
    
    $sql = "DELETE FROM blogueur WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindParam('id',$id);

    try{
        $query->execute();
        header("location: ../controller/index.php");
    }
    catch(PDOException $e){
        echo $e;
    }
    
} else{
    /* verifier si paramettre id exite */
    if(empty(trim($_GET["id"]))){
        header("location: ../view/error.php");
        exit();
    }
}
?>
<?php require '../view/deleteV.php'; ?>