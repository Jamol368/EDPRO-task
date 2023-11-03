<?php

namespace common\models;

use backend\models\RequestUpdateHistory;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string $client_name
 * @property string $request_name
 * @property int $product
 * @property string $phone
 * @property int $created_at
 * @property int|null $status
 * @property string|null $comment
 * @property float|null $price
 *
 * @property RequestUpdateHistory[] $requestUpdateHistories
 */
class Request extends \yii\db\ActiveRecord
{

    public const PRODUCT_APPLES = 1;

    public const PRODUCT_ORANGES = 2;

    public const PRODUCT_MANDARINS = 3;

    public const STATUS_PENDING = 1;

    public const STATUS_ACCEPTED = 2;

    public const STATUS_REJECTED = 3;

    public const STATUS_INVALID = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name', 'request_name', 'product', 'phone'], 'required'],
            [['product', 'created_at', 'status'], 'integer'],
            [['comment'], 'string'],
            [['price'], 'number'],
            [['client_name', 'request_name', 'phone'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_PENDING],
            ['status', 'in', 'range' => [self::STATUS_PENDING, self::STATUS_ACCEPTED, self::STATUS_REJECTED, self::STATUS_INVALID]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Client Name',
            'request_name' => 'Request Name',
            'product' => 'Product',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'status' => 'Status',
            'comment' => 'Comment',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[RequestUpdateHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestUpdateHistories()
    {
        return $this->hasMany(RequestUpdateHistory::class, ['request_id' => 'id']);
    }

    public static function getProducts()
    {
        return [
            self::PRODUCT_APPLES => 'Apples',
            self::PRODUCT_ORANGES => 'Oranges',
            self::PRODUCT_MANDARINS => 'Mandarins',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ACCEPTED => 'Accepted',
            self::STATUS_REJECTED => 'Rejected',
            self::STATUS_INVALID => 'Invalid',
        ];
    }

    public function getProduct()
    {
        return $this::getProducts()[$this->product];
    }

    public function getStatus()
    {
        return $this::getStatuses()[$this->status];
    }
}
