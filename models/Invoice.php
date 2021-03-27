<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Invoice extends Model
{
    public $item_name;
    public $description;
    public $cost;
    public $quantity;
    public $price;


    /**
     * @return array the validation rules.
     */
    public static function tableName()   
    {   
        return 'invoice';   
    } 
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['item_name', 'description', 'cost', 'quantity','price'], 'required','type' =>'string'],
            // email has to be a valid email address
            [['cost','price'], 'type' => 'number'],
        ];
    }



    public function store($data=array()){
        $sql = $queryBuilder->insert('user', [
            'item_name' => $data['item_name'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'quantity' => $data['quantity'],
            'price' => $data['price']
            ], $params);
    }


    public function send($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
