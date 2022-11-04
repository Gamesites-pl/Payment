<?php

namespace Gamesites\Payment\Integration\PaySafeCardPayByLink\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;
use Symfony\Component\Form\FormInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $sha256 = hash('sha256', $this->authOperator->getFieldTwo() . $this->authOperator->getFieldThree() . $order->getDiscountedPrice());

        $formData = [
            'userid' => $this->authOperator->getFieldTwo(),
            'shopid' => $this->authOperator->getFieldOne(),
            'amount' => $order->getDiscountedPrice(),
            'return_ok' => $this->uri,
            'return_fail' => $this->uri,
            'url' => $this->statusUri,
            'control' => $order->getId(),
            'hash' => $sha256,
            'description' => $order->getName(),
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
