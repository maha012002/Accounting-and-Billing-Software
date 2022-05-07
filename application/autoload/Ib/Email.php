<?php

class Ib_Email
{
    protected $contents;
    protected $values = [];

    public static function _init()
    {
        global $config;
        $sysEmail = $config['sysEmail'];
        $sysCompany = $config['CompanyName'];
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $e = ORM::for_table('sys_emailconfig')->find_one('1');
        if ($e['method'] == 'smtp') {
            $mail->isSMTP();
            $mail->Host = $e['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $e['username'];
            $mail->Password = $e['password'];
            $mail->SMTPSecure = $e['secure'];
            $mail->Port = $e['port'];
        }
        $mail->SetFrom($sysEmail, $sysCompany);
        $mail->AddReplyTo($sysEmail, $sysCompany);
        return $mail;
    }

    public static function _log($userid, $email, $subject, $message, $iid = '0')
    {
        $date = date('Y-m-d H:i:s');
        $d = ORM::for_table('sys_email_logs')->create();
        $d->userid = $userid;
        $d->sender = '';
        $d->email = $email;
        $d->subject = $subject;
        $d->message = $message;
        $d->date = $date;
        $d->iid = $iid;
        $d->save();
        $id = $d->id();
        return $id;
    }

    public static function _send(
        $name,
        $to,
        $subject,
        $message,
        $uid = '0',
        $iid = '0',
        $cc = '',
        $bcc = '',
        $attachment_path = '',
        $attachment_file = ''
    ) {
        $mail = self::_init();
        $mail->AddAddress($to, $name);

        if ($cc != '') {
            $mail->AddAddress($cc);
        }

        if ($bcc != '') {
            $mail->AddBCC($bcc);
        }

        if ($attachment_path != '') {
            $mail->AddAttachment(
                $attachment_path,
                $attachment_file,
                'base64',
                'application/pdf'
            );
        }

        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        global $_app_stage;
        if ($_app_stage == 'Demo') {
        } else {
            $mail->Send();
        }

        self::_log($uid, $to, $subject, $message, $iid);
    }

    public static function bulk_email($emails, $subject, $msg, $to)
    {
        $mail = self::_init();

        $mail->AddAddress($to);

        foreach ($emails as $email) {
            $mail->AddBCC($email);
        }

        $mail->Subject = $subject;
        $mail->MsgHTML($msg);

        if ($mail->Send()) {
            return true;
        }

        return false;
    }

    public static function send_client_welcome_email($data)
    {
        $e = ORM::for_table('sys_email_templates')
            ->where('tplname', 'Client:Client Signup Email')
            ->find_one();

        if (!isset($data['account']) || !isset($data['email'])) {
            return false;
        }

        if ($e) {
            global $config;

            $subject = new Template($e['subject']);
            $subject->set('business_name', $config['CompanyName']);
            $subj = $subject->output();

            $message = new Template($e['message']);
            $message->set('client_name', $data['account']);
            $message->set('client_email', $data['email']);
            $message->set('client_password', $data['password']);
            $message->set('business_name', $config['CompanyName']);
            $message->set('client_login_url', U . 'client/login/');
            $message_o = $message->output();

            $mail = Notify_Email::_init();
            $mail->AddAddress($data['email'], $data['account']);
            $mail->Subject = $subj;
            $mail->MsgHTML($message_o);

            $send = $mail->Send();

            return $send;
        }

        return false;
    }

    public static function sendEmail($to, $subject, $message)
    {
        $mail = self::_init();
        $mail->AddAddress($to);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
