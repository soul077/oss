<?php

declare(strict_types=1);

namespace Gone\Oss;


interface OssInterface
{
    public function upload(string $filePath, string $object, array $options = []);

    public function download();

    public function remove();
}