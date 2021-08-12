<?php

namespace weiyun\models\card;

use Yii;

/**
 * This is the model class for table "wy_card_activity_rela".
 *
 * @property int $id
 * @property string $batch_code 唯一编码(wy_opr_card_batch表)
 * @property string $activity_code 活动code
 * @property int $create_time 创建时间
 */
class CardActivityRela extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wy_card_activity_rela';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time'], 'integer'],
            [['batch_code'], 'string', 'max' => 8],
            [['activity_code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'batch_code'    => '批次编号',
            'activity_code' => '活动code',
            'create_time'   => '创建时间',
        ];
    }
}
