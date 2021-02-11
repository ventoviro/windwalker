<?php

/**
 * Part of Windwalker Packages project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace Windwalker\ORM\Test;

use PHPUnit\Framework\TestCase;
use Windwalker\Database\Test\AbstractDatabaseTestCase;
use Windwalker\ORM\ORM;
use Windwalker\ORM\Test\Entity\Article;

/**
 * The ORMTest class.
 */
class ORMTest extends AbstractDatabaseTestCase
{
    protected ?ORM $instance;

    /**
     * @see  ORM::findOne
     */
    public function testFindOne(): void
    {
        $article = $this->instance->findOne(Article::class, 1);

        show($article);
    }

    /**
     * @see  ORM::__construct
     */
    public function test__construct(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    /**
     * @see  ORM::getDb
     */
    public function testGetDb(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    /**
     * @see  ORM::from
     */
    public function testFrom(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    /**
     * @see  ORM::setDb
     */
    public function testSetDb(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    /**
     * @see  ORM::conditionsToWheres
     */
    public function testConditionsToWheres(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    /**
     * @see  ORM::select
     */
    public function testSelect(): void
    {
        self::markTestIncomplete(); // TODO: Complete this test
    }

    protected function setUp(): void
    {
        $this->instance = new ORM(self::$db);
    }

    protected function tearDown(): void
    {
    }

    /**
     * @inheritDoc
     */
    protected static function setupDatabase(): void
    {
        self::importFromFile(__DIR__ . '/Stub/data.sql');
    }
}
