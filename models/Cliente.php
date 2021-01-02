<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nombre
 * @property string $contacto
 * @property string $telefono
 * @property string $email
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre', 'contacto'], 'string', 'max' => 50],
            [['telefono'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 200],
            [['nombre', 'contacto', 'telefono', 'email'], 'trim'], // Removes white spaces from left and right
            [['email'], 'email'],
            [['email'], 'unique'],
            [['contacto', 'telefono', 'email'], 'default', 'value'=>null], // Sets the default value when the field is left empty
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Company name',
            'contacto' => 'Contact person',
            'telefono' => 'Phone number',
            'email' => 'Email',
        ];
    }
}
