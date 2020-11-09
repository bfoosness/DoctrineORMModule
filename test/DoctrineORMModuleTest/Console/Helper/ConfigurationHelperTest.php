<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace DoctrineORMModuleTest\Console\Helper;

use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use DoctrineORMModule\Service\MigrationsCommandFactory;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use DoctrineORMModule\Console\Helper\ConfigurationHelper;
use DoctrineORMModuleTest\ServiceManagerFactory;
use InvalidArgumentException;
use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase;

/**
 * Tests for {@see \DoctrineORMModule\Service\MigrationsCommandFactory}
 *
 * @covers \DoctrineORMModule\Service\MigrationsCommandFactory
 */
class ConfigurationHelperTest extends TestCase
{
    /** @var ServiceManager */
    private $serviceLocator;

    public function setUp(): void
    {
        $this->serviceLocator = ServiceManagerFactory::getServiceManager();
    }

    public function testCreate(): void
    {
        $configurationHelper = new ConfigurationHelper($this->serviceLocator);

        $this->assertInstanceOf(
            ConfigurationHelper::class,
            $configurationHelper
        );
    }

    public function testGetMigrationConfig(): void
    {
        $configurationHelper = new ConfigurationHelper($this->serviceLocator);
        $configuration = $configurationHelper->getMigrationConfig(new ArrayInput([]));

        $this->assertEquals(
            $this->serviceLocator->get('doctrine.migrations_configuration.orm_default'),
            $configuration
        );
    }
}