<?php

namespace Gamesites\Payment\Integration\CashBill\Request;

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
            'service' => $this->operatorData->getFieldTwo(),
            'amount' => $order->getDiscountedPrice(),
            'desc' =>  $order->getName(),
            'userdata' => $requestData['orderId'],
        ];

        $formData['sign'] = md5(
            $formData['service'] . '|' . $formData['amount'] . '||' . $formData['desc'] . '||' . $formData['userdata'] . '||||||||||||' .  $this->operatorData->getFieldOne()
        );

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
