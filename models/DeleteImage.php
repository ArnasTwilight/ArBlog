<?php

namespace app\models;

use Yii;
use yii\base\Model;

class DeleteImage extends Model
{
    private $dir;

    private $id;
    private $image;

    private function prepareParams($model, $dir)
    {
        $this->dir = $dir;
        $this->id = $model->id;
        $this->image = $model->image;
    }

    public function deleteImage($model, $dir)
    {
        $this->prepareParams($model, $dir);

        if($this->checkFileExist()){
            unlink($this->getDirImage() . '/' . $model->image);
            $model->image = '';

            $model->save(false);
        }
        return true;
    }

    public function deleteDirImage($model, $dir)
    {
        $this->prepareParams($model, $dir);

        if(is_dir($this->getDirImage())){
            rmdir($this->getDirImage());
        }
    }

    private function getDirImage ()
    {
        return Yii::getAlias('@web') . 'uploads/' . $this->dir . '/' . $this->id;
    }

    private function checkFileExist()
    {
        if (!is_dir($this->getDirImage())){
            return false;
        }

        if (count(scandir($this->getDirImage())) == 2) {
            return false;
        }

        if (!file_exists($this->getDirImage() . '/' . $this->image)) {
            return false;
        }

        return true;
    }
}
