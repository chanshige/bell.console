<?php
declare(strict_types=1);

namespace Bell\Console;

use Aura\Di\ContainerBuilder;
use Aura\Di\ContainerConfigInterface;
use Bell\AuraDi\Common;
use Bell\AuraDi\Resolve;
use Psr\Container\ContainerInterface;
use Throwable;

/**
 * Class ContainerFactory
 *
 * @package Bell\Console
 */
final class ContainerFactory
{
    /** @var ContainerConfigInterface[] */
    private $configClasses = [];

    /**
     * ContainerFactory constructor.
     *
     * @param ContainerConfigInterface[] $configClasses
     */
    public function __construct(array $configClasses = [])
    {
        $this->configClasses = $configClasses ?: [Common::class];
    }

    /**
     * Build Container.
     *
     * @param bool $autoResolve
     * @return ContainerInterface
     * @throws Throwable
     */
    public function build(bool $autoResolve = ContainerBuilder::AUTO_RESOLVE): ContainerInterface
    {
        return (new ContainerBuilder)->newConfiguredInstance($this->configClasses, $autoResolve);
    }
}
