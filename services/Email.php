<?php
/**
 * FecShop file.
 *
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

namespace fecshop\queue\services;

use yii\base\BaseObject;
use yii\queue\JobInterface;
//use yii\queue\RetryableJobInterface;
use fecshop\queue\job\SendEmailJob;
/**
 * Coupon.
 * @author Terry Zhao <2358269014@qq.com>
 * @since 1.0
 */

class Email extends \fecshop\services\Email
{
    
    /**
     * @property $sendInfo | Array �� example��
     * [
     *	'to' => $to,
     *	'subject' => $subject,
     *	'htmlBody' => $htmlBody,
     *	'senderName'=> $senderName,
     * ]
     * @property $mailerConfigParam | array or String�����ڸò��������ã�
     * �����Բο�����ĺ��� function actionMailer($mailerConfigParam = '') ���ߵ� @fecshop/config/services/Email.php�ο� $mailerConfig������
     * �ú������ڷ����ʼ�.
     */
    protected function actionSend($sendInfo, $mailerConfigParam = '')
    {
        $to         = isset($sendInfo['to']) ? $sendInfo['to'] : '';
        $subject    = isset($sendInfo['subject']) ? $sendInfo['subject'] : '';
        $htmlBody   = isset($sendInfo['htmlBody']) ? $sendInfo['htmlBody'] : '';
        $senderName = isset($sendInfo['senderName']) ? $sendInfo['senderName'] : '';
        if (!$subject) {
            Yii::$service->helper->errors->add('email title is empty');

            return false;
        }
        if (!$htmlBody) {
            Yii::$service->helper->errors->add('email body is empty');

            return false;
        }

        $mailer = $this->mailer($mailerConfigParam);
        if (!$mailer) {
            Yii::$service->helper->errors->add('compose is empty, you must check you email config');

            return false;
        }

        if (!$this->_from) {
            Yii::$service->helper->errors->add('email send from is empty');

            return false;
        } else {
            $from = $this->_from;
        }
        if ($senderName) {
            $setFrom = [$from => $senderName];
        } else {
            $setFrom = $from;
        }
        $compose = $mailer->compose()
            ->setFrom($setFrom)
            ->setTo($to)
            ->setSubject($subject)
            ->setHtmlBody($htmlBody);
        // $compose->send();
        // ????????????????��?
        \Yii::$app->queue->push(new SendEmailJob([
            'compose' => $compose,
        ]));
        return true;
    }
    

}