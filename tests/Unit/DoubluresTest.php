<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

interface EnvoiAlerte
{
    public function envoyer(string $message): bool;
}

class AlerteEquipe
{
    public function __construct(private EnvoiAlerte $envoi) {}

    public function avertir(string $titre): bool
    {
        return $this->envoi->envoyer("Equipe : $nom");
    }
}

class DoubluresTest extends TestCase
{
    public function test_stub_fournit_une_reponse_prevue(): void
    {
        $envoi = $this->createStub(EnvoiAlerte::class);
        $envoi->method('envoyer')->willReturn(true);

        $this->assertTrue((new AlerteEquipe($envoi))->avertir('Essai'));
    }

    public function test_mock_verifie_l_appel_attendu(): void
    {
        $envoi = $this->createMock(EnvoiAlerte::class);
        $envoi->expects($this->once())
            ->method('envoyer')
            ->with('Equipe : Essai')
            ->willReturn(true);

        $this->assertTrue((new AlerteEquipe($envoi))->avertir('Essai'));
    }
}
