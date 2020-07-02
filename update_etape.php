<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', '');


    if(isset($_GET['id_eleve']) && isset($_GET['id_etape'])){

        $id_eleve = $_GET['id_eleve'];
        $id_etape = $_GET['id_etape'];
        $date = (new DateTime('now'))->format('Y-m-d');


        var_dump($id_eleve, $id_eleve, $date);

        $req = "INSERT INTO valider (fk_id_eleve, fk_id_etape, date_validation) VALUES (:id_eleve, :id_etape, :date)";
        $req = $bdd->prepare($req);
        $req->bindParam('id_eleve', $id_eleve);
        $req->bindParam('id_etape', $id_etape);
        $req->bindParam('date', $date);
        $req->execute();

        header('Location: mes_tp.php');
    }