<?php

namespace App\Tests\Command;

use App\Command\SummatorCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class SummatorCommandTest extends TestCase
{
    public function testExecute(): void
    {
        $application = new Application();
        $application->add(new SummatorCommand());

        $command = $application->find('app:summator');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'directory' => 'tests/Fixtures/First',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Total counts: 15', $output);
    }

    public function testExecuteMultipleFiles(): void
    {
        $application = new Application();
        $application->add(new SummatorCommand());

        $command = $application->find('app:summator');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'directory' => 'tests/Fixtures/Second',
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Total counts: 25', $output);
    }
}
