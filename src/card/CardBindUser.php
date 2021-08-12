<?php

namespace weiyun\models\card;

use Carbon\Carbon;
use common\consts\CommonConsts;
use Yii;

/**
 * This is the model class for table "wy_card_bind_user".
 *
 * @property int $id
 * @property string $batch_code 唯一编码(wy_opr_card_batch表)
 * @property string $card_no 卡号
 * @property string $user_code 用户编码
 * @property string $app_id 业务平台 (application表app_id)
 * @property int $valid_time 有效截至日期
 * @property int $card_status 状态 1-正常，0-禁用 
 * @property int $create_time 创建时间
 */
class CardBindUser extends \yii\db\ActiveRecord
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
        return 'wy_card_bind_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valid_time', 'card_status', 'create_time'], 'integer'],
            [['batch_code', 'user_code'], 'string', 'max' => 8],
            [['card_no'], 'string', 'max' => 12],
            [['app_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'batch_code'  => '批次编码',
            'card_no'     => '卡号',
            'user_code'   => '用户Code',
            'app_id'      => '应用ID',
            'valid_time'  => '有效时间',
            'card_status' => '状态 | 1-正常 2-禁用',
            'create_time' => '创建时间',
        ];
    }

    /**
     * 定义场景
     * @return array|array[]
     * @author zhangbeile
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[CommonConsts::SCENARIO_SAVE] = [
            'id',
            'batch_code',
            'card_no',
            'user_code',
            'app_id',
            'valid_time',
            'create_time',
        ];
        return $scenarios;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $currentTime = Carbon::now()->timestamp;
        if ($this->getIsNewRecord()) {
            $this->create_time = $currentTime;
        }
        return parent::beforeSave($insert);
    }

    /**
     * 获取某个用户的会员卡信息
     * @param $user_code
     * @return CardBindUser|null
     * @USER shikang
     * @date 2021/8/10 15:37
     */
    public static function getUserCard($user_code)
    {
        return self::findOne(['user_code' => $user_code, 'card_status' => self::CARD_STATUS_YES]);
    }


}
