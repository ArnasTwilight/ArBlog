<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\imagine\Image;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    const EXTENSIONS = 'png,jpg,jpeg,jpe';

    public $image;

    private $dirName;
    private $idElement;
    private $currentImage;
    private $resizeX;
    private $resizeY;


    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => self::EXTENSIONS],
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage, $dirName, $idElement, $resizeX, $resizeY)
    {
        $this->image = $file;
        $this->dirName = $dirName;
        $this->idElement = $idElement;
        $this->currentImage = $currentImage;
        $this->resizeX = $resizeX;
        $this->resizeY = $resizeY;

        return $this->saveImage();
    }

    private function checkFolderExists()
    {
        if (!is_dir($this->getDir())) {
            mkdir($this->getDir());
        }
    }

    private function checkFileExists()
    {
        if (!empty($this->currentImage)) {
            if (file_exists($this->getDir() . '/' . $this->currentImage)) {
                unlink($this->getDir() . '/' . $this->currentImage);
            }
        }
    }

    private function getDir()
    {
        return Yii::getAlias('@web') . 'uploads/' . $this->dirName . '/' . $this->idElement;
    }

    private function getUniqueName()
    {
        return $filename = strtolower(md5(uniqId($this->image->baseName)) . '.' . $this->image->extension);
    }

    private function resizeImage($filename)
    {
        $Image = Yii::getAlias('@webroot/uploads/' . $this->dirName . '/' . $this->idElement) . '/' . $filename;

        Image::resize($Image, $this->resizeX, $this->resizeY, true)
            ->save($Image, ['quality' => 90]);
    }

    private function saveImage()
    {
        if ($this->validate()) {
            $this->checkFolderExists();
            $this->checkFileExists();
            $filename = $this->getUniqueName();

            $this->image->saveAs($this->getDir() . '/' . $filename);

            $this->resizeImage($filename);

            return $filename;
        }
        return false;
    }

}