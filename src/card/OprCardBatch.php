<?php

namespace weiyun\models\card;

use Yii;

/**
 * This is the model class for table "wy_opr_card_batch".
 *
 * @property int $id
 * @property string $batch_code 唯一编码
 * @property string $card_image 会员卡图片file_id
 * @property int $card_count 会员卡数量
 * @property int $valid_time 有效截至日期
 * @property string $channel_code 渠道code(对应ims_opr_channel表channel_code)
 * @property string $app_id 业务平台 (application表app_id)
 * @property int $card_status 状态 1-正常，0-禁用 
 * @property int $create_time 创建时间
 */
class OprCardBatch extends \yii\db\ActiveRecord
{
    /**
     * 状态 1-正常， 0-禁用
     */
    const CARD_STATUS_YES = 1;
    const CARD_STATUS_NO = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wy_opr_card_batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_count', 'valid_time', 'card_status', 'create_time'], 'integer'],
            [['batch_code'], 'string', 'max' => 8],
            [['card_image', 'app_id'], 'string', 'max' => 32],
            [['channel_code'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch_code' => 'Batch Code',
            'card_image' => 'Card Image',
            'card_count' => 'Card Count',
            'valid_time' => 'Valid Time',
            'channel_code' => 'Channel Code',
            'app_id' => 'App ID',
            'card_status' => 'Card Status',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * 根据批次编码获取批次信息
     * @param $batch_code
     * @return OprCardBatch|null
     * @author shikang
     * @date 2021/8/10 16:45
     */
    public static function getBatchInfo($batch_code)
    {
        return self::findOne(['batch_code' => $batch_code, 'card_status' => self::CARD_STATUS_YES]);
    }
}
