<?php

namespace Gamesites\Payment\Operator;

abstract class AbstractAuthOperator
{
    protected ?string $fieldOne = null;
    protected ?string $fieldTwo = null;
    protected ?string $fieldThree = null;

    abstract public function validate();

    public function getFieldOne(): ?string
    {
        return $this->fieldOne;
    }

    public function getFieldTwo(): ?string
    {
        return $this->fieldTwo;
    }

    public function getFieldThree(): ?string
    {
        return $this->fieldThree;
    }

    public function setFieldOne(?string $fieldOne): AbstractAuthOperator
    {
        $this->fieldOne = $fieldOne;

        return $this;
    }

    public function setFieldTwo(?string $fieldTwo): AbstractAuthOperator
    {
        $this->fieldTwo = $fieldTwo;

        return $this;
    }

    public function setFieldThree(?string $fieldThree): AbstractAuthOperator
    {
        $this->fieldThree = $fieldThree;

        return $this;
    }
}
