<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;

/**
 * ThreadView AR
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property int $new_last_seen
 * @property int $edited_last_seen
 */
class ThreadViewActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_thread_view}}';
    }
}
