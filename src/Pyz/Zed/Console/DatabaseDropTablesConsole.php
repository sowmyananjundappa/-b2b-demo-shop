<?php

namespace Pyz\Zed\Propel\Communication\Console;

use Exception;
use Propel\Runtime\Connection\Exception\ConnectionException;
use Spryker\Shared\Config\Config;
use Spryker\Shared\Propel\PropelConstants;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Spryker\Zed\Propel\Communication\Console\DatabaseDropTablesConsole as SprykerDatabaseDropTablesConsole;

class DatabaseDropTablesConsole extends SprykerDatabaseDropTablesConsole
{
    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->info('Dropping all database tables.');

        try {
            $this->getFacade()->dropDatabaseTables();
            $this->info('All database tables have been dropped.');
        } catch (ConnectionException $exception) {
            $this->error('Database is not reachable.');
            var_dump(getenv('SPRYKER_PAAS_SERVICES'));
            var_dump(Config::get(PropelConstants::ZED_DB_HOST));
            var_dump(Config::get(PropelConstants::ZED_DB_PORT));
            var_dump(Config::get(PropelConstants::ZED_DB_USERNAME));
            var_dump(Config::get(PropelConstants::ZED_DB_DATABASE));
            var_dump(Config::get(PropelConstants::ZED_DB_PASSWORD));
            $this->error($exception->getMessage());
            $this->error($exception->getTraceAsString());

            return static::CODE_ERROR;
        } catch (Exception $exception) {
            $this->error('Error happened during dropping database tables.');
            $this->error($exception->getMessage());

            return static::CODE_ERROR;
        }

        return static::CODE_SUCCESS;
    }
}
