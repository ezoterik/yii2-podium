<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;
use bizley\podium\models\Message;
use bizley\podium\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * MessageReceiver AR
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property int $message_id
 * @property int $receiver_id
 * @property int $receiver_status
 * @property int $updated_at
 * @property int $created_at
 */
class MessageReceiverActiveRecord extends ActiveRecord
{
    /**
     * Statuses.
     */
    const STATUS_NEW     = 1;
    const STATUS_READ    = 10;
    const STATUS_DELETED = 20;

    /**
     * @var string Sender name
     */
    public $senderName;

    /**
     * @var string Message topic
     */
    public $topic;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_message_receiver}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return array_merge(
            parent::scenarios(),
            ['remove' => ['receiver_status']]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['receiver_id', 'message_id'], 'required'],
            [['receiver_id', 'message_id'], 'integer', 'min' => 1],
            ['receiver_status', 'in', 'range' => static::getStatuses()],
            [['senderName', 'topic'], 'string']
        ];
    }

    /**
     * Returns list of statuses.
     * @return string[]
     */
    public static function getStatuses()
    {
        return [self::STATUS_NEW, self::STATUS_READ, self::STATUS_DELETED];
    }

    /**
     * Message relation.
     * @return ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::class, ['id' => 'message_id']);
    }

    /**
     * Receiver relation.
     * @return ActiveQuery
     */
    public function getReceiver()
    {
        return $this->hasOne(User::class, ['id' => 'receiver_id']);
    }
}
