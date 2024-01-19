<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;

class LoginBackendCest
{
    public function _before(FunctionalTester $I)
    {


    }
    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }
    public function testLoginWithValidCredentials(FunctionalTester $I)
    {


        $I->amOnPage('/site/login');
        $I->wantTo('Test login with valid credentials');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'admin123',
        ]);

        $I->dontSee('Incorrect username or password.');
        $I->see('Página');
    }

    public function testLoginWithInvalidCredentials(FunctionalTester $I)
    {
        $I->amOnPage('/site/login');
        $I->wantTo('Test login with invalid credentials');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'joaquim',
            'LoginForm[password]' => 'maria',
        ]);

        $I->see('Incorrect username or password.');
        $I->seeElement('#login-form');
    }
}