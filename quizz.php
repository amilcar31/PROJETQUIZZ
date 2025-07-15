
<?php

if(($myfile = fopen("score", "r")) >= 0) {
    if(filesize("score"))
        $score = (int)fread($myfile, filesize("score"));
    else
        $score = 0;
    fclose($myfile);
}
else {
    touch("score");
    $score = 0;
}

echo "Votre score précédent était : $score\n";

$score = 0;

$questions = [
    "Quelle est la couleur du cheval blanc d'Henri IV?\n1.Blanc\n2.Rouge\n3.Noir\n",
    "Date de la prise de la Bastille ?\n1.1750\n2.1789\n3.1800\n",
    "Quel est le plus grand océan du monde ?\n1.Océan Atlantique\n2.Océan Indien\n3.Océan Pacifique\n",
    "Qui a écrit Les Misérables ?\n1.Victor Hugo\n2.Emile Zola\n3.Marcel Proust\n",
    "Quelle est la capitale de l'Australie ?\n1.Sydney\n2.Melbourne\n3.Canberra\n"
];

$reponses = [1, 2, 3, 1, 3];

$NB_QUESTIONS = count($questions);
$increment = 10;

for($i = 0; $i < $NB_QUESTIONS; $i++){
    echo "Question : ".$questions[$i]."\n";
    $reponse = trim(fgets(STDIN));
    if($reponse == $reponses[$i]) {
        echo "Bonne réponse\n";
        $score = $score + $increment;
    }
    else {
        echo "Mauvaise réponse\n";
        echo "La bonne répoonse est : ".$reponses[$i]."\n";
    }   
    echo "Votre secore est : $score\n";
}
echo "Votre score final est : $score\n";
$pourcentage = (($score / $increment) / $NB_QUESTIONS) * 100;
echo "Pourcentage de bonnes réponses : $pourcentage %\n";
if($pourcentage >= 0.5)
    echo "Vous avez gagné des millions\n";

$myfile = fopen("score", "w") or die("Unable to open file!");
fwrite($myfile, $score);
fclose($myfile);

?>