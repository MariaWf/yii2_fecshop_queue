<?php
/**
 * FecShop file.
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

return [
    /**
     * �����ǵ�������չ��������÷�ʽ
     */
    // �������չextensions���ܿ��أ�true�����
    'enable' => true, 
    // ������ڵ�����
    'app' => [
        // 1.���ò�
        'common' => [
            // �ڹ��ò�Ŀ��أ����ó�false�󣬹��ò�����ý�ʧЧ
            'enable' => true,
            // ���ò�ľ���������������
            'config' => [
                'components' => [
                    'queue' => [
                        'class'  => \yii\queue\redis\Queue::class,
                        'as log' => \yii\queue\LogBehavior::class,
                        // ����������ѡ��
                    ],
                ],
                'modules' => [
                    
                ],
            ],
        ],
        
        'console' => [
            'enable' => true,
            'config' => [
                'bootstrap' => [
                    'queue', // ��������ע�ᵽ����̨
                ],
            ],
        ],
        
    ],
    
];









