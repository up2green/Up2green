<?php

namespace Up2green\PropelPaymentCoreBundle\Model;

use JMS\Payment\CoreBundle\Model\FinancialTransactionInterface as JMSFinancialTransactionInterface;
use Up2green\PropelPaymentCoreBundle\Model\om\BaseFinancialTransaction;

/**
 * Financial transaction entity
 */
class FinancialTransaction extends BaseFinancialTransaction implements FinancialTransactionInterface
{
    public function setTransactionType($transactionType)
    {
        switch ($transactionType) {
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_APPROVE :
                parent::setTransactionType('approve');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_APPROVE_AND_DEPOSIT :
                parent::setTransactionType('approve-and-deposit');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_CREDIT :
                parent::setTransactionType('credit');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_DEPOSIT :
                parent::setTransactionType('deposit');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_APPROVAL :
                parent::setTransactionType('reverse-approval');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_CREDIT :
                parent::setTransactionType('reverse-credit');
                break;
            case JMSFinancialTransactionInterface::TRANSACTION_TYPE_REVERSE_DEPOSIT :
                parent::setTransactionType('reverse-deposit');
                break;
            default:
                parent::setTransactionType($transactionType);
                break;
        }
    }

    public function getTransactionType()
    {
        return constant('JMS\Payment\CoreBundle\Model\FinancialTransactionInterface::TRANSACTION_TYPE_'.strtoupper(parent::getTransactionType()));
    }

    public function setState($state)
    {
        switch ($state) {
            case JMSFinancialTransactionInterface::STATE_CANCELED :
                parent::setState('canceled');
                break;
            case JMSFinancialTransactionInterface::STATE_FAILED :
                parent::setState('failed');
                break;
            case JMSFinancialTransactionInterface::STATE_NEW :
                parent::setState('new');
                break;
            case JMSFinancialTransactionInterface::STATE_PENDING :
                parent::setState('pending');
                break;
            case JMSFinancialTransactionInterface::STATE_SUCCESS :
                parent::setState('success');
                break;
            default:
                parent::setState($state);
                break;
        }
    }

    public function getState()
    {
        return constant('JMS\Payment\CoreBundle\Model\FinancialTransactionInterface::STATE_'.strtoupper(parent::getState()));
    }
}