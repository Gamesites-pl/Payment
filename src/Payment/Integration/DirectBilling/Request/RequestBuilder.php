<?php

namespace Gamesites\Payment\Integration\DirectBilling\Request;

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
            'SEKRET' => $this->operatorData->getFieldOne(),
            'KWOTA' => $order->getDiscountedPrice(),
            'PRZEKIEROWANIE_SUKCESS' => $this->uri,
            'PRZEKIEROWANIE_BLAD' => $this->uri,
            'ID_ZAMOWIENIA' => $requestData['orderId'],
        ];

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
