<?php


namespace SoftUniBlogBundle\Service\message;

use SoftUniBlogBundle\Entity\Message;

interface MessageServiceInterface
{
    public function create(Message $message, int $recipientId) : bool;

    public function getAllByUser();

    public function getOne(int $id) : ?Message;

    public function getAllUnseenByUser();
}