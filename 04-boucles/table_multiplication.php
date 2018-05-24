<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table multiplication</title>
</head>
<body>

 
    <?php 
    echo '<table>';
        echo '<thead><tr>';
        echo '<th>x</th>';
        for($head=0 ; $head<=10 ; $head++){
            echo "<th> $head </th>";
        }
        echo "</tr></thead>";
        echo "<tr>";
        echo "<td> $ligne </td>";
        for($ligne=0 ; $ligne<=10 ; $ligne++){
            for($colonne=0 ; $colonne<=10 ; $colonne++){
                $resultat = $ligne*$colonne ;
                echo "<td> $resultat </td>";
            }
        echo "</tr>";
        }
    echo '</table>';

    ?> 



</body>
</html>

