<?php

echo strlen('V€r'); // Compte le nombre d'octets donc renvoie 5 (le € prend 3 octets)

echo @$variableNotExists; // @ permet de masquer les erreurs (notice)

echo @kkk;

//$tableau = [];
echo @count($tableau);

