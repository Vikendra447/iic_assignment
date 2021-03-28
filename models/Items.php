<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Items extends ActiveRecord
{
    protected $name;
    protected $description;
    protected $unit_cost;
    protected $quantity;
    protected $price;

    public function rules()
    {
        return [
            [['name', 'description', 'unit_cost', 'quantity','price'], 'required'],
            [['name', 'description'], 'string'],
            [['unit_cost', 'quantity','price'], 'number','min'=> 0],
        ];
    }

    public static function tableName()   
    {   
        return 'items';   
    }
}
