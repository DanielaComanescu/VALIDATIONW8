<?php

spl_autoload_register(function ($class_name) {
    require 'classes/' . $class_name . '.php';
});

$player1 = new Warrior('Cloup');
$player2 = new Archer('Vivi');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baston</title>
</head>
<body>
    <?php while ($player1->isAlive() && $player2->isAlive()): ?>
        <div>
            <p><?= $player1->turn($player2) ?></p>
            <?php $result = "$player1->name a gagné !" ?>
            <?php if ($player2->isAlive()): ?>
                <p><?= $player2->turn($player1) ?></p>
                <?php $result = "$player2->name a gagné !" ?>
            <?php endif ?>
        </div>
    <?php endwhile ?>
    <p class="gagne"> QUI A GAGNE ? </p>
    <p><?= $result ?></p>
    
</body>
</html>
