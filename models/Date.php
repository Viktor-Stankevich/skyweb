<?php

namespace app\Models;

use yii\db\ActiveRecord;

class Date extends ActiveRecord
{

  public static function tableName()
  {
    return 'booked';
  }

  public function rules()
  {
    return [
      ['booked', 'unique']
    ];
  }

}