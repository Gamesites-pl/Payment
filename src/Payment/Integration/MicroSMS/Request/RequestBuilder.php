<?php

namespace Gamesites\Payment\Integration\MicroSMS\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Gamesites\Payment\Dto\Price;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;
use Symfony\Component\Form\FormInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(Price|DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $md5 = md5($this->authOperator->getFieldTwo() . $this->authOperator->getFieldOne() . $order->getDiscountedPrice());

        $formData = [
            'shopid' => $this->authOperator->getFieldTwo(),
            'signature' => $md5,
            'amount' => $order->getDiscountedPrice(),
            'control' => $order->getId(),
            'return_urlc' => $this->statusUri,
            'return_url' => $this->uri,
            'description' => $order->getName(),
            'test' => 'false'
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
