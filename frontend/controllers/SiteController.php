<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\UserSocialMedia;
use yii\helpers\Url;
use common\models\User;
use frontend\models\Category;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth'=>[
        'class'=>'yii\authclient\AuthAction',
         'successCallback' => [$this, 'successCallback'],     
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    $categories = Category::find()->all();
   
        return $this->render('index',[
            'categories'=>$categories]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignups()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }





public function safeAttributes($client){
    $attributes = $client->getUserAttributes();
     $safe_attributes = [
            'social_media'=>'',
            'id'=>'',
            'username'=>'',
            'name'=>'',
            'email'=>'',];


            if($client instanceof \yii\authclient\clients\Facebook){
                 $safe_attributes = [
            'social_media'=>'facebook',
            'id'=>$attributes['id'],
            'username'=>$attributes['email'],
            'name'=>$attributes['name'],
            'email'=>$attributes['email'],];

            }

   else if($client instanceof \yii\authclient\clients\Google){
                 $safe_attributes = [
            'social_media'=>'google',
            'id'=>$attributes['id'],
            'username'=>$attributes['emails']['0']['value'],
            'name'=>$attributes['displayName'],
            'email'=>$attributes['emails']['0']['value'],];

            }
            
  else if($client instanceof \yii\authclient\clients\Twitter){
                 $safe_attributes = [
            'social_media'=>'twitter',
            'id'=>$attributes['id'],
            'username'=>$attributes['screen_name'],
            'name'=>$attributes['name'],
            'email'=>'-',];

            }

  else if($client instanceof \yii\authclient\clients\Github){
                 $safe_attributes = [
            'social_media'=>'github',
            'id'=>$attributes['id'],
            'username'=>$attributes['login'],
            'name'=>$attributes['name'],
            'email'=>$attributes['email'],];

            }


                    return $safe_attributes;
}


            public function successCallback($client){
                $attributes = $this->safeAttributes($client);

                $user_social_media = UserSocialMedia::find()
                ->where([
                    'social_media'=>$attributes['social_media'],
                    'id'=>(string)$attributes['id'],
                    'username'=>$attributes['username'],
                    ])
                ->one();

                if($user_social_media){
                    $user= $user_social_media->user;
                    if($user->status == User::STATUS_ACTIVE){
                        Yii::$app->user->login($user);
                    }           
            else{ 
                Yii::$app->session->setFlash('error','Login gagal, status user tidak aktif'); 
            }
            } else{
                $user = User::find()->where(['email'=>$attributes['email']])->one();
                if($user){
                if($user->status==User::STATUS_ACTIVE){
                    $user_social_media = new UserSocialMedia([
                        'social_media'=>$attributes['social_media'],
                        'id'=>(string)$attributes['id'],
                        'username'=>$attributes['username'],
                        'user_id'=>$user->id,
                        ]);
                    $user_social_media->save();

                    Yii::$app->user->login($user);
                }
                else{
                   Yii::$app->session->setFlash('error','Login gagal, status user tidak aktif');
                }
            }
            else{
                    if($attributes['social_media'] !='twitter'){
                        $password = Yii::$app->security->generateRandomString(6);
                        $user =  new User([
                            'username'=>$attributes['username'],
                            'email'=>$attributes['email'],
                            'password'=>$password,
                            ]);
                        $user->generateAuthKey();
                        $user->generatePasswordResetToken();
                        if($user->save()){
                            $user_social_media = new UserSocialMedia([
                                'social_media'=>$attributes['social_media'],
                                'id'=>(string)$attributes['id'],
                                'username'=>$attributes['username'],
                                'user_id'=>$user->id,
                                ]);
                            $user_social_media->save();


                            Yii::$app->user->login($user);
                        }
                        else{
                   Yii::$app->session->setFlash('error','Login gagal, galat saat registrasi');


                        }
                    }
                    else{
                        $session = Yii::$app->session;
                        $session['attributes']=$attributes;

                        $this->action->successUrl =  Url::to(['signup']);
                    }
                }

            }
        }

 public function actionSignup()
    {
        $model = new SignupForm();

        $session = Yii::$app->session;
        $attributes= $session['attributes'];



        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {

                    
                if ($session->has('attributes')){
                    $user_social_media = new UserSocialMedia([
                        'social_media'=>$attributes['social_media'],
                        'id'=>(string)$attributes['id'],
                        'username'=>$attributes['username'],
                        'user_id'=>$user->id,]);
                    $user_social_media->save();
                }

                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
            if($session->has('attributes')){
                $model->username = $attributes['username'];
                $model->email = $attributes['email'];
            }
        return $this->render('signup', [
            'model' => $model,
            ]);
    }








}
