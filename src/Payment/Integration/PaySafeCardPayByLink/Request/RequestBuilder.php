<?php

namespace Gamesites\Payment\Integration\PaySafeCardPayByLink\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Dto\PriceInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(array $requestData, PriceInterface|DetailInterface $order): FormInterface
    {
        $this->operatorData->validate();

        $sha256 = hash('sha256', $this->operatorData->getFieldTwo() . $this->operatorData->getFieldThree() . $order->getDiscountedPrice());

        $formData = [
            'userid' => $this->operatorData->getFieldTwo(),
            'shopid' => $this->operatorData->getFieldOne(),
            'amount' => $order->getDiscountedPrice(),
            'return_ok' => $this->uri,
            'return_fail' => $this->uri,
            'url' => $this->statusUri,
            'control' => $requestData['orderId'],
            'hash' => $sha256,
            'description' =>$order->getName(),
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
