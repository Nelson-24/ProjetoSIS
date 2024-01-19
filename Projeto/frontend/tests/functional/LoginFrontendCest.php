<?php

namespace frontend\tests\functional;

use backend\tests\FunctionalTester;

class LoginFrontendCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');

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


        $I->submitForm('#login-form', $this->formParams('admin', 'admin123'));
        $I->see('Tijolo');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');

    }

}