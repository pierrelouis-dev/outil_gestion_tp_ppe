<!DOCTYPE html>

<html>
<head>
    <title>TP PHP</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div>
    <?php
    session_start();

    if (isset($_SESSION['id'])) header('Location: mes_tp.php');

    $bdd = new PDO('mysql:host=127.0.0.1;dbname=outils_geestion_tp_ppe', 'root', '');

    if (isset($_POST['subinscrire'])) {
        header("Location: inscription.php");
    }

    if (isset($_POST['subconnect'])) {
        $loginconnect = htmlspecialchars($_POST['loginconnect']);/*Ne pas pouvoir mettre des caracteres speciaux dans le champ nom */
        $mdpconnect = md5($_POST['mdpconnect']);/*Crypté le mdp en md5 */
        $role = $_POST['role'];

        if (!empty($loginconnect) && !empty($mdpconnect)) {

            if ($role == 'eleve') {
            $requser = $bdd->prepare("SELECT e.*,r.nom_role FROM eleve e, roles r WHERE e.id_role = r.id AND login = ? AND mdp = ? ");
            $requser->execute(array($loginconnect,$mdpconnect));/*Insert du contenu=e de nom et de mdp*/
            $userexist = $requser->rowcount();
            $infouser = $requser ->fetch();
            if($userexist !=0)
            {
                if ($infouser ['statut_inscription'] ==1 ){
                $_SESSION['id'] = $infouser['id_eleve'];
                $_SESSION['login'] = $infouser['login'];
                $_SESSION['role'] = $infouser['nom_role'];
                //Mettre dans la session l'option
                $id_eleve = $_SESSION['id'];
                $req = $bdd->prepare("SELECT option_e, fk_id_promo FROM eleve WHERE id_eleve = :ideleve");
                $req->bindParam('ideleve', $id_eleve);
                $req->execute();
                $user = $req ->fetch();
                $_SESSION['option_e'] = $user['option_e'];
                $_SESSION['fk_id_promo'] = $user['fk_id_promo'];
                header("Location: mes_tp.php");

                }
                else{

                    $erreur = "Votre inscription n'est pas encore validé par un prof";
                }
                
            } 

            } else {
               $requser_prof = $bdd->prepare("SELECT p.*,r.nom_role  FROM prof p,roles r WHERE p.id_role = r.id AND login = ? AND mdp = ? ");
                        $requser_prof->execute(array($loginconnect,$mdpconnect));/*Insert du contenu=e de nom et de mdp*/
                        $userexist_prof = $requser_prof->rowcount();
                        if($userexist_prof !=0)
                        {
                    
                            $infouser_prof = $requser_prof ->fetch();
                            if ($infouser_prof['statut_inscription'] ==1 ){
                            $_SESSION['id'] = $infouser_prof['id_prof'];
                            $_SESSION['login'] = $infouser_prof['login'];
                            $_SESSION['role'] = $infouser_prof['nom_role'];
                            header("Location: tp_en_cours.php");
                            }
                            else

                            $erreur = "Votre inscription n'est pas encore validé par un prof";
                        } 
            }
        } else {
            $erreur = "Tous les champs doivent etre complétés!";
        }

    }

    ?>

        <!--Début formulaire-->
            <form method="POST" action="">
                <div class="col-12 form-co">
                    <div class="champs-co">
                        <span class="login-title">Connexion</span>
                        <br>
                        <label>Nom</label>
                        <br>
                        <input type="text" name="loginconnect" class="champs champs-nom-co">
                        <br>
                        <label>Mot de passe</label>
                        <br>
                        <input type="password" name="mdpconnect" class="champs champs-mdp">
                        </br>
                        <select name="role">
                            <option value="eleve">Eleve</option>
                            <option value="prof">Prof</option>
                        </select>

                        <input type="submit" name="subconnect" value="se connecter" class="btn-connecter">
                    </div>
                    <div class="error">
                        <?php
                        /*Afficher la valeur de erreur si la variable erreur existe*/
                        if (isset($erreur)) {
                            echo $erreur;
                        }

                        ?>
                    </div>
                </div>

            </form>

        </div>
    </body>
</html>