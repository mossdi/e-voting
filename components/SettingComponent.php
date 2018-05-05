<?php
namespace app\components;

use yii\base\Component;
use app\entities\Setting;

/**
 * Class SettingComponent
 * @package app\components
 */
class SettingComponent extends Component {

    protected $data = array();

    public function init() {
        parent::init();

        $items = Setting::find()->all();

        foreach ($items as $item) {
            if ($item->param) {
                $this->data[$item->param] = $item->value === '' ? $item->default : $item->value;
            }
        }
    }

    public function get($key) {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            throw new Exception('Undefined parameter ' . $key);
        }
    }

    public function set($key, $value) {
        $model = Setting::model()->findByAttributes(array('param' => $key));

        if (!$model) {
            throw new Exception('Undefined parameter ' . $key);
        }

        $this->data[$key] = $value;

        $model->value = $value;

        $model->save();
    }
}
