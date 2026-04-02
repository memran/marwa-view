<?php

declare(strict_types=1);

namespace Marwa\View\Tests\Support;

trait CreatesTemporaryFiles
{
    /**
     * @var list<string>
     */
    private array $temporaryPaths = [];

    protected function makeTempDirectory(string $prefix = 'marwa-view-test-'): string
    {
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $prefix . bin2hex(random_bytes(6));
        if (!mkdir($path, 0777, true) && !is_dir($path)) {
            throw new \RuntimeException("Failed to create temporary directory '{$path}'");
        }

        $this->temporaryPaths[] = $path;

        return $path;
    }

    protected function writeFile(string $path, string $contents): void
    {
        $directory = dirname($path);
        if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
            throw new \RuntimeException("Failed to create directory '{$directory}'");
        }

        if (file_put_contents($path, $contents) === false) {
            throw new \RuntimeException("Failed to write file '{$path}'");
        }
    }

    protected function cleanupTemporaryPaths(): void
    {
        foreach (array_reverse($this->temporaryPaths) as $path) {
            $this->removeDirectory($path);
        }

        $this->temporaryPaths = [];
    }

    private function removeDirectory(string $path): void
    {
        if (!is_dir($path)) {
            return;
        }

        $items = scandir($path);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $entry = $path . DIRECTORY_SEPARATOR . $item;
            if (is_dir($entry)) {
                $this->removeDirectory($entry);
                continue;
            }

            unlink($entry);
        }

        rmdir($path);
    }
}
