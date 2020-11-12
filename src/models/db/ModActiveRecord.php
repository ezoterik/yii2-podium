<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * Mod AR
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property int $user_id
 * @property int $forum_id
 */
class ModActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_moderator}}';
    }

    /**
     * Forum relation.
     * @return ActiveQuery
     */
    public function getForum()
    {
        return $this->hasOne(static::class, ['id' => 'forum_id']);
    }
}
