<?php
/**
 * @category   Ktpl
 * @package    Ktpl_CustomerCredit
 */

namespace Ktpl\CustomerCredit\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		/**
		 * Creating table credit_limit
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('credit_limit')
		)->addColumn(
			'enitity_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'customer_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Customer ID'
		)->addColumn(
			'customer_email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Email ID'
		)->addColumn(
			'credit_limit',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Credit limit'		
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->setComment(
            'Credit Limit Table'
        );
		$installer->getConnection()->createTable($table);
		
		/**
		 * Creating table credit_limit_report
		 */
		
		$table = $installer->getConnection()->newTable(
		$installer->getTable('credit_limit_report')
		)->addColumn(
			'report_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Report Id'
		)->addColumn(
			'customer_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Customer ID'
		)->addColumn(
			'customer_email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Customer Email'
		)->addColumn(
			'order_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Order ID'		
		)->addColumn(
			'initial_credits',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Original Credits'
		)->addColumn(
			'used_credits',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Used Credits'			
		)->addColumn(
			'available_credits',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Available Credits'			
		)->addColumn(
			'credit_usage',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Credit Usage (in %)'				
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->setComment(
            'Credit Limit Report Table'
        );
		$installer->getConnection()->createTable($table);
		
		$installer->endSetup();
	}
}