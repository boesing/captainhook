<?php
/**
 * This file is part of CaptainHook.
 *
 * (c) Sebastian Feldmann <sf@sebastian.feldmann.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace CaptainHook\App\Console\Command\Hook;

use CaptainHook\App\Console\IO\NullIO;
use CaptainHook\App\Git\DummyRepo;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use PHPUnit\Framework\TestCase;

class PostCommitTest extends TestCase
{
    /**
     * Tests PostCommit::run
     */
    public function testExecute(): void
    {
        if (\defined('PHP_WINDOWS_VERSION_MAJOR')) {
            $this->markTestSkipped('not tested on windows');
        }

        $repo = new DummyRepo();
        $repo->setup();

        $cmd    = new PostCommit(CH_PATH_FILES . '/config/empty.json', $repo->getPath());
        $output = new NullOutput();
        $input  = new ArrayInput([]);

        $cmd->setIO(new NullIO());
        $cmd->run($input, $output);

        $repo->cleanup();

        $this->assertTrue(true);
    }
}