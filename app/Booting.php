<?php

declare(strict_types=1);

namespace App;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Types\Type;
use Nette\Configurator;

class Booting
{
	/**
	 * @throws DBALException
	 */
	public static function boot(): Configurator
	{
		$configurator = new Configurator;

		$configurator->setDebugMode(isset($_SERVER['DEBUG']) && $_SERVER['DEBUG'] === 'true');
		$configurator->enableTracy(__DIR__ . '/../log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory(__DIR__ . '/../temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig(__DIR__ . '/Config/common.neon');

		Type::addType('uuid_binary', 'Ramsey\Uuid\Doctrine\UuidBinaryType');

		return $configurator;
	}
}
