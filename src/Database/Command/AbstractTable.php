<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2014 - 2015 LYRASOFT. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

namespace Windwalker\Database\Command;

use Windwalker\Database\Driver\AbstractDatabaseDriver;
use Windwalker\Database\Driver\DatabaseAwareTrait;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Database\Schema\Schema;

/**
 * Class DatabaseTable
 *
 * @since 2.0
 */
abstract class AbstractTable
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = null;

	/**
	 * A cache to store Table columns.
	 *
	 * @var \stdClass[]
	 */
	protected $columnCache = array();

	/**
	 * Property indexesCache.
	 *
	 * @var  \stdClass[]
	 */
	protected $indexCache;

	/**
	 * Property driver.
	 *
	 * @var  \Windwalker\Database\Driver\AbstractDatabaseDriver
	 */
	protected $db;

	/**
	 * Constructor.
	 *
	 * @param string         $table
	 * @param AbstractDatabaseDriver $db
	 */
	public function __construct($table, AbstractDatabaseDriver $db)
	{
		$this->table = $table;

		$this->db = $db;
	}

	/**
	 * create
	 *
	 * @param   callable|Schema $callback
	 * @param   bool            $ifNotExists
	 * @param   array           $options
	 *
	 * @return  static
	 */
	abstract public function create($callback, $ifNotExists = true, $options = array());

	/**
	 * update
	 *
	 * @param   callable|Schema  $schema
	 *
	 * @return  static
	 */
	public function update($schema)
	{
		$schema = $this->callSchema($schema);

		foreach ($schema->getColumns() as $column)
		{
			$this->addColumn($column);
		}

		foreach ($schema->getIndexes() as $index)
		{
			$this->addIndex($index);
		}

		return $this->reset();
	}

	/**
	 * save
	 *
	 * @param   callable|Schema  $schema
	 * @param   bool             $ifNotExists
	 * @param   array            $options
	 *
	 * @return  $this
	 */
	public function save($schema, $ifNotExists = true, $options = array())
	{
		$schema = $this->callSchema($schema);

		if ($this->exists())
		{
			$this->update($schema);
		}
		else
		{
			$this->create($schema, $ifNotExists, $options);
		}

		$database = $this->db->getDatabase();
		$database::resetCache();

		return $this->reset();
	}

	/**
	 * drop
	 *
	 * @param bool   $ifExists
	 * @param string $option
	 *
	 * @return  static
	 */
	public function drop($ifExists = true, $option = '')
	{
		$builder = $this->db->getQuery(true)->getBuilder();

		$query = $builder::dropTable($this->table, $ifExists, $option);

		$this->db->setQuery($query)->execute();

		return $this;
	}

	/**
	 * exists
	 *
	 * @return  boolean
	 */
	public function exists()
	{
		$database = $this->db->getDatabase();

		return $database->tableExists($this->table);
	}

	/**
	 * rename
	 *
	 * @param string  $newName
	 * @param boolean $returnNew
	 *
	 * @return  $this
	 */
	abstract public function rename($newName, $returnNew = true);

	/**
	 * Locks a table in the database.
	 *
	 * @return  static  Returns this object to support chaining.
	 *
	 * @since   2.0
	 * @throws  \RuntimeException
	 */
	public function lock()
	{
		$this->db->setQuery('LOCK TABLES ' . $this->db->quoteName($this->table) . ' WRITE');

		return $this;
	}

	/**
	 * unlock
	 *
	 * @return  static  Returns this object to support chaining.
	 *
	 * @throws  \RuntimeException
	 */
	public function unlock()
	{
		$this->db->setQuery('UNLOCK TABLES')->execute();

		return $this;
	}

	/**
	 * Method to truncate a table.
	 *
	 * @return  static
	 *
	 * @since   2.0
	 * @throws  \RuntimeException
	 */
	public function truncate()
	{
		$this->db->setQuery('TRUNCATE TABLE ' . $this->db->quoteName($this->table))->execute();

		return $this;
	}

	/**
	 * getDetail
	 *
	 * @return  array|boolean
	 */
	public function getDetail()
	{
		return $this->db->getDatabase()->getTableDetail($this->table);
	}

	/**
	 * Get table columns.
	 *
	 * @return array Table columns with type.
	 */
	public function getColumns()
	{
		return array_keys($this->getColumnDetails());
	}

	/**
	 * getColumnDetails
	 *
	 * @param bool $refresh
	 *
	 * @return mixed
	 */
	abstract public function getColumnDetails($refresh = false);

	/**
	 * getColumnDetail
	 *
	 * @param   string  $column
	 *
	 * @return \stdClass
	 */
	public function getColumnDetail($column)
	{
		$columns = $this->getColumnDetails();

		return isset($columns[$column]) ? $columns[$column] : null;
	}

	/**
	 * addColumn
	 *
	 * @param string $name
	 * @param string $type
	 * @param bool   $signed
	 * @param bool   $allowNull
	 * @param string $default
	 * @param string $comment
	 * @param array  $options
	 *
	 * @return  static
	 */
	abstract public function addColumn($name, $type = 'text', $signed = true, $allowNull = true, $default = '', $comment = '', $options = array());

	/**
	 * dropColumn
	 *
	 * @param string $name
	 *
	 * @return  mixed
	 */
	public function dropColumn($name)
	{
		$builder = $this->db->getQuery(true)->getBuilder();

		$query = $builder ::dropColumn($this->table, $name);

		$this->db->setQuery($query)->execute();

		return $this;
	}

	/**
	 * modifyColumn
	 *
	 * @param string|Column  $name
	 * @param string $type
	 * @param bool   $signed
	 * @param bool   $allowNull
	 * @param string $default
	 * @param string $comment
	 * @param array  $options
	 *
	 * @return  static
	 */
	abstract public function modifyColumn($name, $type = 'text', $signed = true, $allowNull = true, $default = '', $comment = '', $options = array());

	/**
	 * changeColumn
	 *
	 * @param string $oldName
	 * @param string|Column  $newName
	 * @param string $type
	 * @param bool   $signed
	 * @param bool   $allowNull
	 * @param string $default
	 * @param string $comment
	 * @param array  $options
	 *
	 * @return  static
	 */
	abstract public function changeColumn($oldName, $newName, $type = 'text', $signed = true, $allowNull = true, $default = '', $comment = '', $options = array());

	/**
	 * addIndex
	 *
	 * @param string $type
	 * @param string $name
	 * @param array  $columns
	 * @param string $comment
	 * @param array  $options
	 *
	 * @return  static
	 */
	abstract public function addIndex($type, $name = null, $columns = array(), $comment = null, $options = array());

	/**
	 * dropIndex
	 *
	 * @param string  $name
	 *
	 * @return  static
	 */
	abstract public function dropIndex($name);

	/**
	 * getIndexes
	 *
	 * @return  array
	 */
	abstract public function getIndexes();

	/**
	 * Method to get property Table
	 *
	 * @return  string
	 */
	public function getName()
	{
		return $this->table;
	}

	/**
	 * Method to set property table
	 *
	 * @param   null|string $table
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setName($table)
	{
		$this->table = $table;

		return $this;
	}

	/**
	 * Method to get property Db
	 *
	 * @return  \Windwalker\Database\Driver\AbstractDatabaseDriver
	 */
	public function getDriver()
	{
		return $this->db;
	}

	/**
	 * Method to set property db
	 *
	 * @param   \Windwalker\Database\Driver\AbstractDatabaseDriver $db
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setDriver($db)
	{
		$this->db = $db;

		return $this;
	}

	/**
	 * getSchema
	 *
	 * @return  Schema
	 */
	public function getSchema()
	{
		return new Schema($this);
	}

	/**
	 * callSchema
	 *
	 * @param   callable|Schema  $schema
	 *
	 * @return  Schema
	 */
	protected function callSchema($schema)
	{
		if (!$schema instanceof Schema && is_callable($schema))
		{
			$s = $this->getSchema();

			call_user_func($schema, $s);

			$schema = $s;
		}

		if (!$schema instanceof Schema)
		{
			throw new \InvalidArgumentException('Argument 1 should be Schema object.');
		}

		return $schema;
	}

	/**
	 * getTypeMapper
	 *
	 * @return  DataType
	 */
	public function getTypeMapper()
	{
		$driver = ucfirst($this->db->getName());

		return sprintf('Windwalker\Database\Driver\%s\%sType', $driver, $driver);
	}

	/**
	 * prepareColumn
	 *
	 * @param Column $column
	 *
	 * @return  Column
	 */
	protected function prepareColumn(Column $column)
	{
		$typeMapper = $this->getTypeMapper();

		$type   = $typeMapper::getType($column->getType());
		$length = $column->getLength() ? : $typeMapper::getLength($type);

		$length = $length ? '(' . $length . ')' : null;

		return $column->type($type)
			->length($length);
	}

	/**
	 * reset
	 *
	 * @return  static
	 */
	public function reset()
	{
		$this->columnCache = array();
		$this->indexCache = array();

		return $this;
	}
}
