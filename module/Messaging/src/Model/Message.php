<?php

namespace Message\Model;


class Message
{
    public $id;
    public $name;
    public $email;
    public $subject;
    public $message;
    public $date_sent;
    public $status;
    public $delete_flag;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->email = !empty($data['email']) ? $data['email'] : null;
        $this->subject = !empty($data['subject']) ? $data['subject'] : null;
        $this->message = !empty($data['message']) ? $data['message'] : null;
        $this->date_sent = !empty($data['date_sent']) ? $data['date_sent'] : null;
        $this->status = !empty($data['status']) ? $data['status'] : null;
        $this->delete_flag = !empty($data['delete_flag']) ? $data['delete_flag'] : null;
    }
}