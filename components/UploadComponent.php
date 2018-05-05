<?php

namespace app\components;

use Yii;
use app\entities\Speech;
use app\entities\SpeechLogo;

class UploadComponent
{
    /**
     * @param $file
     * @param Speech $model
     * @return void
     * @throws \Exception
     */
    public function uploadSpeechLogo($file, Speech $model)
    {
        $model->file = $file;

        if ($model->validate(['file'])) {
            $fileName = $model->file->baseName . '.' . $model->file->extension; //TODO: сделать генерацию уникального имени файла

            $model->file->saveAs(Yii::getAlias('@webroot/image/logo/' . $fileName));

            $speechLogo = new SpeechLogo();

            $speechLogo->speech_id = $model->id;
            $speechLogo->image = $fileName;

            if (!$speechLogo->save()) {
                throw new \Exception('Не удалось сохранить логотип!');
            }
        }

        $model->file = null;
    }
}
