<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO-CRUD-MySQL</title>
</head>

<body>
    <?php
        // Constantes d'environnement 
        define("DBHOST", "localhost");
        define("DBUSER", "root");
        define("DBPASS", "mysql");
        define("DBNAME", "api_php");

        // DSN de connexion
        $dsn = "mysql:dbname=" .DBNAME.";host=".DBHOST;

        // On va se connecter à la base
        try {
            // On instancie PDO
            $db = new PDO($dsn, DBUSER, DBPASS);

            // On s'assure d'envoyer les données en UTF8
            $db->exec("SET NAMES utf8");

            // On définit le mode de "fetch" par défaut
            $db->setAttribute
            (PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            die("Error".$e->getMessage()); 

        }

        // Ici on est connecté à la bd
        $sql = "SELECT SELECT f.id, f.libelle, f.description, f.image, c.libelle as 'categorie'
        from formation f inner join categorie c on f.categorie_id = c.id";

        // On exécute directement la requête
        //$req = $db->query($sql);

        $stmt = $db->prepare($sql);
        $stmt->execute();

        // On récupère les données en tableau (fetch ou fetchAll)

        $formations = $stmt->fetchAll();

        echo "<pre>";
        var_dump($formations);
        echo "</pre>";
    ?>
</body>

</html>