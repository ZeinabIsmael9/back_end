<?php

namespace App\Session;

class SessionHandler implements \SessionHandlerInterface
{
    public function __construct(
        protected string $save_path,
        protected string $prefix
    ) {
        if (!is_dir($this->save_path)) {
            mkdir($this->save_path, 0755, true);
        }
    }

    public function close(): bool
    {
        return true;
    }

    public function destroy(string $id): bool
    {
        $file = $this->save_path . '/' . $this->prefix . $id;
        if (file_exists($file)) {
            unlink($file);
        }
        return true;
    }

    public function gc(int $max_lifetime): int
    {
        $count = 0;
        foreach (glob($this->save_path . '/' . $this->prefix . '*') as $file) {
            if (filemtime($file) + $max_lifetime < time()) {
                unlink($file);
                $count++;
            }
        }
        return $count;
    }

    public function open(string $path, string $name): bool
    {
        return is_dir($this->save_path);
    }

    public function read(string $id): string|false
    {
        $file = $this->save_path . '/' . $this->prefix . $id;
        return file_exists($file) ? file_get_contents($file) : '';
    }

    public function write(string $id, string $data): bool
    {
        return (bool)file_put_contents(
            $this->save_path . '/' . $this->prefix . $id,
            $data
        );
    }
}
