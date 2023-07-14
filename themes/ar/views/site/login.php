<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="logo d-flex align-items-center w-auto">
                        <img src="<?= Yii::getAlias("@web/img/logo.png") ?>" alt="">
                        <span class="d-none d-lg-block">NiceAdmin</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4"><?= Yii::t('login', 'Login to Your Account')?></h5>
                            <p class="text-center small"><?= Yii::t('login', 'Enter your username & password to login')?></p>
                        </div>
                        <?php $form = ActiveForm::begin(); ?>

                            <div class="col-12">
                                <?= $form->field($model, 'username')->textInput(['id' => 'yourUsername', 'required' => true])->label(Yii::t('login', 'Username'), ['class' => 'form-label']) ?>
                            </div>

                            <div class="col-12">
                                <?= $form->field($model, 'password')->passwordInput(['id' => 'yourPassword', 'required' => true])->label(Yii::t('login', 'Password'), ['class' => 'form-label']) ?>
                            </div>

                            <div class="col-12">
                                <?= $form->field($model, 'rememberMe')->checkbox(['value' => 'true', 'id' => 'rememberMe'], false)->label(Yii::t('login', 'Remember Me')) ?>
                            </div>

                            <div class="col-12">
                                <?= Html::submitButton(Yii::t('login', 'Login'), ['class' => 'btn btn-primary w-100']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

            </div>
        </div>
    </div>

</section>
