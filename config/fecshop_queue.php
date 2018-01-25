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
                        //'as log' => \yii\queue\LogBehavior::class,
                        'ttr' => 5 * 60, // Max time for anything job handling 
                        'attempts' => 3, // Max number of attempts
                        // ����������ѡ��
                    ],
                ],
                'services' => [
                    'email' => [
                        'class' => 'fecshop\queue\services\Email',
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









