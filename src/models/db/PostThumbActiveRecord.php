<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * PostThumb model
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 * @property int $created_at
 * @property int $updated_at
 */
class PostThumbActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_post_thumb}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [TimestampBehavior::class];
    }
}
