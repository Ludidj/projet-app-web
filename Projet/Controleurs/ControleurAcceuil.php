<?php

declare(strict_types=1);

class ControleurAcceuil{

private $vue;

public function __construct(Vue $vue){
    $this->vue = $vue;
}



public function afficherAcceuil(): void
{
    $nomProjet = ''; //SPORTMANAGER MAIS HEADER EST DEJA DANS GABARIT
    $auteur = 'Ludivine Djeni';
    $versionPhp = PHP_VERSION;
    $titrePage = $nomProjet;

    $this->vue->afficher('acceuil',[
        'nomProjet'=> $nomProjet,
        'auteur' => $auteur,
        'versionPhp' =>$versionPhp,
        'titrePage'=> $titrePage

    ]);
}

public function afficherRecits(): void
{
    $this->vue->afficher(
        'recits',
        [],
        'Récits'
    );
}



   
}
