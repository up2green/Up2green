<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\PaymentInstructionInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BasePaymentInstruction;

class PaymentInstruction extends BasePaymentInstruction implements PaymentInstructionInterface
{
    /**
     * @return Up2green\PropelPaymentCoreBundle\Model\FinancialTransaction
     */
    public function getPendingTransaction()
    {
        foreach ($this->getPayments() as $payment) {
            if (null !== $transaction = $payment->getPendingTransaction()) {
                return $transaction;
            }
        }

        foreach ($this->getCredits() as $credit) {
            if (null !== $transaction = $credit->getPendingTransaction()) {
                return $transaction;
            }
        }

        return null;
    }

    /**
     * @return boolean
     */
    public function hasPendingTransaction()
    {
        return null !== $this->getPendingTransaction();
    }

    public function setState($state)
    {
        switch ($state) {
            case PaymentInstructionInterface::STATE_CLOSED :
                parent::setState('closed');
                break;
            case PaymentInstructionInterface::STATE_INVALID :
                parent::setState('invalid');
                break;
            case PaymentInstructionInterface::STATE_NEW :
                parent::setState('new');
                break;
            case PaymentInstructionInterface::STATE_VALID :
                parent::setState('valid');
                break;
            default:
                parent::setState($state);
                break;
        }
    }

    public function getState()
    {
        return constant('JMS\Payment\CoreBundle\Model\PaymentInstructionInterface::STATE_'.strtoupper(parent::getState()));
    }
}