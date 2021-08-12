<?php

namespace weiyun\models\card;

use Yii;

/**
 * This is the model class for table "wy_opr_card".
 *
 * @property int $id
 * @property string $batch_code 唯一编码(wy_opr_card_batch表)
 * @property string $card_no 卡号
 * @property string $card_password 卡密
 * @property string $user_code 用户编码
 * @property int $card_type 卡类型 （1-实体，2-虚拟）
 * @property int $is_bind 是否绑定（0-否，1-是）
 * @property int $create_time 创建时间
 */
class OprCard extends \yii\db\ActiveRecord
{
    /**
     * 是否绑定
     * 1-是，0-否
     */
    const IS_BIND_YES = 1;
    const IS_BIND_NO = 0;

    /**
     * 卡类型
     * 1-虚拟，2-实体
     */
    const CARD_TYPE_ST = 2;
    const CARD_TYPE_XN = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wy_opr_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_type', 'is_bind', 'create_time','bind_time'], 'integer'],
            [['batch_code', 'user_code'], 'string', 'max' => 8],
            [['card_no'], 'string', 'max' => 12],
            [['card_password'], 'string', 'max' => 6],
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
            'card_no'       => '卡号',
            'card_password' => '卡密',
            'user_code'     => '用户Code',
            'card_type'     => '卡类型 | 1-虚拟 2-实体',
            'is_bind'       => '是否绑定 | 1-是 0-否',
            'bind_time'     => '绑定时间',
            'create_time'   => '创建时间',
        ];
    }

    /**
     * 根据卡号获取会员卡信息
     * @param $card_no
     * @return OprCard|null
     * @author shikang
     * @date 2021/8/10 15:52
     */
    public static function getCardInfo($card_no)
    {
        return self::findOne(['card_no' => $card_no]);
    }
}
