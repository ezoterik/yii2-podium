<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;
use bizley\podium\models\Category;
use bizley\podium\models\Post;
use bizley\podium\Podium;
use bizley\podium\slugs\PodiumSluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\helpers\HtmlPurifier;

/**
 * Forum AR
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $sub
 * @property string $slug
 * @property string $keywords
 * @property string $description
 * @property int $visible
 * @property int $sort
 * @property int $updated_at
 * @property int $created_at
 */
class ForumActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_forum}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => Podium::getInstance()->slugGenerator,
                'attribute' => 'name',
                'type' => PodiumSluggableBehavior::FORUM
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'visible'], 'required'],
            ['visible', 'boolean'],
            [['name', 'sub'], 'filter', 'filter' => function ($value) {
                return HtmlPurifier::process(trim($value));
            }],
            [['keywords', 'description'], 'string'],
        ];
    }

    /**
     * Category relation.
     * @return ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Post relation. One latest post.
     * @return ActiveQuery
     */
    public function getLatest()
    {
        return $this->hasOne(Post::class, ['forum_id' => 'id'])->orderBy(['id' => SORT_DESC]);
    }
}
