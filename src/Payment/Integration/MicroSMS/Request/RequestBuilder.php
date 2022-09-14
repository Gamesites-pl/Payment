<?php

namespace Gamesites\Payment\Integration\MicroSMS\Request;

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

        $md5 = md5($this->operatorData->getFieldTwo() . $this->operatorData->getFieldOne() . $order->getDiscountedPrice());

        $formData = [
            'shopid' => $this->operatorData->getFieldTwo(),
            'signature' => $md5,
            'amount' => $order->getDiscountedPrice(),
            'control' => $requestData['orderId'],
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
