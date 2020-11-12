<?php

namespace bizley\podium\models\db;

use bizley\podium\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;
use bizley\podium\Podium;
use bizley\podium\slugs\PodiumSluggableBehavior;

/**
 * Category model
 *
 * @author Paweł Bizley Brzozowski <pawel@positive.codes>
 * @since 0.6
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $keywords
 * @property string $description
 * @property int $visible
 * @property int $sort
 * @property int $updated_at
 * @property int $created_at
 */
class CategoryActiveRecord extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%podium_category}}';
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
                'type' => PodiumSluggableBehavior::CATEGORY
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
            ['name', 'filter', 'filter' => function ($value) {
                return HtmlPurifier::process(trim($value));
            }],
            [['keywords', 'description'], 'string'],
        ];
    }
}
