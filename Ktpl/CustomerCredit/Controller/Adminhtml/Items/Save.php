<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Controller\Adminhtml\Items;

class Save extends \Ktpl\CustomerCredit\Controller\Adminhtml\Items
{
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $model = $this->_objectManager->create('Ktpl\CustomerCredit\Model\CustomerCredit');
                $data = $this->getRequest()->getPostValue();
				$resource = $this->_objectManager->get('Magento\Framework\App\ResourceConnection');
				$connection = $resource->getConnection();
				if(!array_key_exists("enitity_id",$data))
  				{
					$creditCollection = $this->_objectManager->get('Ktpl\CustomerCredit\Model\ResourceModel\CustomerCredit\Collection');
					$creditCollection->addFieldToFilter(['customer_id', 'customer_email'],
					[
						['eq' => $data['customer_id']],
						['eq' => $data['customer_email']]
					]);
					
					if(count($creditCollection->getData()))
					{
						$this->messageManager->addError(
							__('Customer id or Customer email has already in use.')
						);
						$this->_redirect('ktpl_customercredit/*/');
						return;
					}
				}else{
					$tableName = $resource->getTableName('credit_limit');
					$cEnitityId     = $data['enitity_id'];
					$customerId     = $data['customer_id'];
					$customerEmail  = $data['customer_email'];
				
					$creditLimitSql = "Select * FROM " . $tableName. " WHERE enitity_id = '".$cEnitityId."' AND customer_id = '".$customerId."' AND customer_email = '".$customerEmail."'";
					$creditLimitResult = $connection->fetchAll($creditLimitSql);
					
					if(count($creditLimitResult) == 0)
					{
						$this->messageManager->addError(
							__('Customer id or Customer email has already in use.')
						);
						$this->_redirect('ktpl_customercredit/*/');
						return;
					}
				}
				
				$tableName = $resource->getTableName('customer_entity');
				$customerId    = $data['customer_id'];
				$customerEmail = $data['customer_email'];
				
				$customerSql = "Select * FROM " . $tableName. " WHERE entity_id = '".$customerId."' AND email = '".$customerEmail."'";
				$customerResult = $connection->fetchAll($customerSql);
				
				if(count($customerResult) == 0)
				{
					$this->messageManager->addError(
						__("Customer id or Customer email doesn't exist.")
					);
					$this->_redirect('ktpl_customercredit/*/');
					return;
				}
                $inputFilter = new \Zend_Filter_Input(
                    [],
                    [],
                    $data
                );
                $data = $inputFilter->getUnescaped();
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $model->load($id);
                    if ($id != $model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong credit limit is specified.'));
                    }
                }
                $model->setData($data);
                $session = $this->_objectManager->get('Magento\Backend\Model\Session');
                $session->setPageData($model->getData());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the credit limit.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('ktpl_customercredit/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('ktpl_customercredit/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('ktpl_customercredit/*/edit', ['id' => $id]);
                } else {
                    $this->_redirect('ktpl_customercredit/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the credit limit data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('ktpl_customercredit/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('ktpl_customercredit/*/');
    }
}
