<?php


namespace Gone\Oss\Adapter;


use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class QiniuyunAdapter
{
    protected string $accessKeyId;
    protected string $accessKeySecret;
    protected string $bucket;
    private string $token;
    /**
     * @var UploadManager
     */
    private UploadManager $uploadMgr;

    public function __construct(array $config)
    {
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        $this->bucket = $config['bucket']['default'];
    }

    public function init()
    {
        $auth = new Auth($this->accessKeyId, $this->accessKeySecret);
        $this->token = $auth->uploadToken($this->bucket);
        $this->uploadMgr = new UploadManager();
    }

    public function setBucket(string $bucket)
    {
        $this->bucket = $bucket;
    }

    public function upload(string $filePath, string $filename, array $options = []): string
    {
        $params = $options['params'] ?? null;
        $mime = $params['mime'] ?? 'application/octet-stream';
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($this->token, $filename, $filePath, $params, $mime, true, null, 'v2');
        return $err !== null ? $err : $filePath;
    }
}