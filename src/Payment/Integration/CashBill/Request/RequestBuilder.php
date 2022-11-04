<?php

namespace Gamesites\Payment\Integration\CashBill\Request;

use Gamesites\Payment\Dto\DetailInterface;
use Gamesites\Payment\Dto\PayerInterface;
use Symfony\Component\Form\FormInterface;
use Gamesites\Payment\Operator\AbstractRequestOperator;
use Gamesites\Payment\Operator\RequestOperatorInterface;

final class RequestBuilder extends AbstractRequestOperator implements RequestOperatorInterface
{
    public function getForm(DetailInterface $order, ?PayerInterface $payer = null): FormInterface
    {
        $this->authOperator->validate();

        $formData = [
            'service' => $this->authOperator->getFieldTwo(),
            'amount' => $order->getDiscountedPrice(),
            'desc' =>  $order->getName(),
            'userdata' => $order->getId(),
        ];

        $formData['sign'] = md5(
            $formData['service'] . '|' . $formData['amount'] . '||' . $formData['desc'] . '||' . $formData['userdata'] . '||||||||||||' .  $this->authOperator->getFieldOne()
        );

        $form = $this->formFactory->create(FormType::class);
        $form->submit($formData);

        return $form;
    }
}
