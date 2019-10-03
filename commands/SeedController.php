<?php

namespace app\commands;

use app\models\Loan;
use app\models\User;
use app\transformers\LoanTransformer;
use app\transformers\UserTransformer;
use Yii;
use yii\console\Controller;
use app\models\Users;
use app\models\Profile;

class SeedController extends Controller
{
    public function actionUsers()
    {
        $file = Yii::$app->basePath . '/' . 'users.json';
        $users = json_decode(file_get_contents($file), true);

        $transformer = new UserTransformer();
        foreach ($users as $user) {
            echo 'Import : User id ' . $user['id'] . PHP_EOL;
            $model = new User();
            $model->id = $user['id'];
            $model->load($transformer->transform($user));
            if (!$model->save()) {
                echo 'Error : ' . json_encode($model->getErrors()) . PHP_EOL
                    . 'Data  : ' . json_encode($transformer->transform($user)) . PHP_EOL
                    . 'Skiped' . PHP_EOL . PHP_EOL;
            }
        }
    }

    public function actionLoans()
    {
        $file = Yii::$app->basePath . '/' . 'loans.json';
        $loans = json_decode(file_get_contents($file), true);

        $transformer = new LoanTransformer();
        foreach ($loans as $loan) {
            echo  'Import : Loan id ' . $loan['id'] . PHP_EOL;
            $model = new Loan();
            $model->id = $loan['id'];
            $model->load($transformer->transform($loan));
            if (!$model->save()) {
                echo 'Error : ' . json_encode($model->getErrors()) . PHP_EOL
                    . 'Data  : ' . json_encode($transformer->transform($loan)) . PHP_EOL
                    . 'Skiped' . PHP_EOL . PHP_EOL;
            }
        }
    }
}
