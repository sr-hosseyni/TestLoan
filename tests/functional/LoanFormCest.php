<?php

use app\models\User;

class LoanFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amOnPage(['loan/create', 'user_id' => User::find()->limit(1)->one()->id]);
    }

    public function openCreateLoanPage(\FunctionalTester $I)
    {
        $I->wantTo('Check page is loading');
        $I->canSee('Create Loan');
    }

    public function submitEmptyForm(\FunctionalTester $I)
    {
        $I->submitForm('#loan-form', []);
        $I->expectTo('see validations errors');
        $I->see('Create Loan', 'h1');
        $I->see('Amount cannot be blank.');
        $I->see('Interest cannot be blank.');
        $I->see('Duration cannot be blank.');
        $I->see('Start Date cannot be blank.');
        $I->see('End Date cannot be blank.');
    }

    public function submitFormWithIncorrectEmail(\FunctionalTester $I)
    {
        $I->submitForm('#loan-form', [
            'Loan[amount]' => '1000.00',
            'Loan[interest]' => '25.00',
            'Loan[duration]' => '18',
            'Loan[start_date]' => '2019-10-10',
            'Loan[end_date]' => '2021-04-10',
            'Loan[campaign]' => '2',
        ]);

        $I->expectTo('successfully create loan and redirect to loans list');
        $I->dontSeeElement('#loan-form');
        $I->see('', 'div.loan-view');
    }
}
