<?php

declare(strict_types=1);

namespace Gone\Oss;


use Gone\Oss\Adapter\AliyunAdapter;
use Gone\Oss\Adapter\QiniuyunAdapter;
use Gone\Oss\Exception\OssException;
use Hyperf\Context\ApplicationContext;
use Hyperf\Contract\ConfigInterface;

class Oss implements OssInterface
{

    protected AliyunAdapter|QiniuyunAdapter $instance;

    private array $configData;

    public function __construct()
    {
        $this->init();
    }

    public function init(string $name = ''): AliyunAdapter|QiniuyunAdapter
    {
        $config = ApplicationContext::getContainer()->get(ConfigInterface::class);
        $this->configData = $config->get('oss');
        $name = $name ? $name : $this->configData['default'];

        if (empty($name)) {
            throw new OssException('配置文件中default为空');
        }
        $this->instance = new $this->configData[$name]['adapter'];
    }

    public function setBucket(string $bucketName)
    {
        if (isset($this->configData['bucket'][$bucketName])) {
            throw new OssException('配置文件中bucket不存在');
        }
        $this->instance->setBucket($this->configData['bucket'][$bucketName]);
    }

    public function upload(string $filePath, string $object, array $options = [])
    {
        $this->instance->init();
        $this->instance->upload($filePath, $object, $options);
        // TODO: Implement upload() method.
    }

    public function download()
    {
        // TODO: Implement download() method.
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

}