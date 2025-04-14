<?php

namespace App\DTO;

use App\Entity\Subscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriptionDTO extends AbstractController
{
    private $user_id;

    private $title;
    private int $cvv;

    private int $card_number;


    public function getCvv(): int
    {
        return $this->cvv;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setCvv(int $cvv): void
    {
        $this->cvv = $cvv;
    }

    public function getCardNumber(): int
    {
        return $this->card_number;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setCardNumber(int $card_number): void
    {
        $this->card_number = $card_number;
    }
}