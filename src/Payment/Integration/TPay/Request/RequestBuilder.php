<?php

namespace Gamesites\Payment\Integration\TPay\Request;

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

        $formData = [
            'id' => $requestData['orderId'],
            'amount' => $order->getDiscountedPrice(),
            'description' => $order->getName(),
            'crc' => $requestData['orderId'],
            'return_url' => $this->uri,
        ];

        $formData['md5sum'] = md5(implode('&', [$requestData['orderId'], $order->getDiscountedPrice(), $order->getName() . ' ' . $requestData['orderId'], $this->operatorData->getFieldOne()]));

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
