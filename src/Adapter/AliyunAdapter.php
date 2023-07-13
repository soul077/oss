<?php


namespace Gone\Oss\Adapter;


use OSS\Core\OssException;
use OSS\OssClient;

class AliyunAdapter
{
    protected string $accessKeyId;
    protected string $accessKeySecret;
    protected string $endpoint;
    protected string $bucket;
    protected OssClient $ossClient;

    public function __construct(array $config)
    {
        //new OssClient();
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        $this->endpoint = $config['endpoint'];
        $this->bucket = $config['bucket']['default'];
    }

    public function init()
    {
        $this->ossClient = new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint);
    }

    public function upload(string $filePath, string $object, array $options = []): string
    {
        try {
            $this->ossClient->uploadFile($this->bucket, $object, $filePath, $options);
        } catch (OssException $e) {
            return $e->getMessage();
        }
        return $object;
    }

    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }
}