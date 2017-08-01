<?php
 
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\widgets\Connect;
 
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $user
 */
 

?>
<br><br><br>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
  <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                ]); ?>

 
                <?= $form->field($model, 'username') ?>
 
                <?= $form->field($model, 'email') ?>
 
                 <?= $form->field($model, 'password')->passwordInput() ?>
 

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div> 
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">

 
        <?= Html::a('Already registered? Sign in!', ['login']) ?>
                       </p>
    </div>
</div>