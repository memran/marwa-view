<?php

declare(strict_types=1);

namespace Marwa\View\Tests;

use Marwa\View\Support\Path;
use PHPUnit\Framework\TestCase;

final class PathTest extends TestCase
{
    public function testJoinPreservesAbsoluteUnixPaths(): void
    {
        self::assertSame('/var/www/app/views', Path::join('/var/www', 'app', 'views'));
    }

    public function testJoinPreservesWindowsDrivePrefix(): void
    {
        self::assertSame('C:' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR . 'views', Path::join('C:\\', 'project', 'views'));
    }
}
