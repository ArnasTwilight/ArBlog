<?php

namespace app\controllers;

use app\models\DeleteImage;
use app\models\ImageUpload;
use app\models\NewPassword;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class CabinetController extends Controller
{

    public function actionIndex($id)
    {
        if (!empty(User::findOne($id)))
        {
            $this->accessControl($id);

            $user = User::findOne($id);
            unset($user['password'], $user['isAdmin']);
        } else {
            return $this->redirect(['/cabinet', 'id' => Yii::$app->user->identity->id]);
        }

        return $this->render('index', [
            'user' => $user,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->accessControl($id);

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/cabinet', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->accessControl($id);

        $model = $this->findModel($id);

        $deleteImage = new DeleteImage();
        $deleteImage->deleteImage($model, $this->getDirUpload());
        $deleteImage->deleteDirImage($model, $this->getDirUpload());

        $model->delete();

        return $this->redirect(['/']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $this->accessControl($id);

        $model = new ImageUpload;

        if (Yii::$app->request->isPost) {
            $user = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            $user->saveImage($model->uploadFile($file, $user->image, $this->getDirUpload(), $id, 128,128));

            return $this->redirect(['/cabinet', 'id' => $id]);
        }

        return $this->render('image', [
            'model' => $model,
        ]);
    }

    public function actionDeleteImage($id)
    {
        $this->accessControl($id);

        $model = $this->findModel($id);

        $deleteImage = new DeleteImage();
        $deleteImage->deleteImage($model, $this->getDirUpload());


        return $this->redirect(['/cabinet', 'id' => $id]);
    }

    public function actionNewPassword($id)
    {
        $this->accessControl($id);

        $model = new NewPassword;

        if (Yii::$app->request->isPost) {

            $user = $this->findModel($id);
            $model->load(Yii::$app->request->post());

            if ($model->setNewPassword($user))
            {
                return $this->redirect(['/cabinet', 'id' => $id]);
            }
        }

        return $this->render('password', [
            'model' => $model,
        ]);
    }

    private function userIsGuest ()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    }

    private function accessControl ($id)
    {
        $this->userIsGuest();

        if (Yii::$app->user->identity->id != $id)
        {
            return $this->redirect(['/cabinet', 'id' => Yii::$app->user->identity->id]);
        }
    }

    private function getDirUpload()
    {
        return Yii::$app->params['user.dirImage'];
    }
}
