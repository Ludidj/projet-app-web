<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class InscriptionCaptchaTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_captcha_refuse_empeche_l_inscription(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' =>
                Http::response(['success' => false], 200),
        ]);

        $this->post(route('register.store'), [
            'name' => 'Compte test',
            'email' => 'refus@example.test',
            'email_confirmation' => 'refus@example.test',
            'password' => 'mot-de-passe-test',
            'password_confirmation' => 'mot-de-passe-test',
            'g-recaptcha-response' => 'jeton-test',
        ])->assertSessionHasErrors('g-recaptcha-response');

        $this->assertDatabaseMissing('users', ['email' => 'refus@example.test']);
    }
}
