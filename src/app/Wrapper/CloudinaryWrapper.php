<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 12/02/2015
 * Time: 21:43
 */

namespace Samcrosoft\Cloudinary\Wrapper;
use Cloudinary;
use Illuminate\Config\Repository;

class CloudinaryWrapper {


    /**
     * Cloudinary lib.
     *
     * @var \Cloudinary
     */
    protected $cloudinary;

    /**
     * Cloudinary uploader.
     *
     * @var \Cloudinary\Uploader
     */
    protected $uploader;

    /**
     * Repository config.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Uploaded result.
     *
     * @var array
     */
    protected $uploadedResult;

    /**
     * Create a new cloudinary instance.
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->cloudinary = new Cloudinary;

        $this->uploader = new Cloudinary\Uploader;

        $this->config = $config;

        $this->cloudinary->config([
            'cloud_name' => $this->config->get('cloudinary.cloudName'),
            'api_key'    => $this->config->get('cloudinary.apiKey'),
            'api_secret' => $this->config->get('cloudinary.apiSecret')
        ]);
    }

    /**
     * Get cloudinary class.
     *
     * @return \Cloudinary
     */
    public function getCloudinary()
    {
        return $this->cloudinary;
    }

    /**
     * Get cloudinary uploader.
     *
     * @return \Cloudinary\Uploader
     */
    public function getUploader()
    {
        return $this->uploader;
    }

    /**
     * Upload image to cloud.
     *
     * @param  mixed $source
     * @param  string $publicId
     * @param  array  $tags
     * @return CloudinaryWrapper
     */
    public function upload($source, $publicId, $tags = [])
    {
        $defaults = [
            'public_id' => null,
            'tags'      => []
        ];

        $options = array_merge($defaults, [
            'public_id' => $publicId,
            'tags'      => $tags
        ]);

        $this->uploadedResult = $this->getUploader()->upload($source, $options);

        return $this;
    }

    /**
     * Uploaded result.
     *
     * @return array
     */
    public function getResult()
    {
        return $this->uploadedResult;
    }

    /**
     * Uploaded public ID.
     *
     * @return string
     */
    public function getPublicId()
    {
        return $this->uploadedResult['public_id'];
    }

    /**
     * Display image.
     *
     * @param  string $publicId
     * @param  array  $options
     * @return string
     */
    public function show($publicId, $options = [])
    {
        $defaults = $this->config->get('cloudinary.scaling');

        $options = array_merge($defaults, $options);

        return $this->getCloudinary()->cloudinary_url($publicId, $options);
    }

    /**
     * Rename public ID.
     *
     * @param  string $publicId
     * @param  string $toPublicId
     * @param  array  $options
     * @return array
     */
    public function rename($publicId, $toPublicId, $options = [])
    {
        try
        {
            return $this->getUploader()->rename($publicId, $toPublicId, $options);
        }
        catch (\Exception $e) { }

        return false;
    }

    /**
     * Destroy image.
     *
     * @param  string $publicId
     * @param  array  $options
     * @return array
     */
    public function destroy($publicId, $options = [])
    {
        return $this->getUploader()->destroy($publicId, $options);
    }

    /**
     * Alias of destroy.
     *
     * @param $publicId
     * @param array $options
     * @return array
     */
    public function delete($publicId, $options = [])
    {
        $response = $this->destroy($publicId, $options);

        return (boolean) ($response['result'] == 'ok');
    }

    /**
     * Add tag to images.
     *
     * @param string $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function addTag($tag, $publicIds = [], $options = [])
    {
        return $this->getUploader()->add_tag($tag, $publicIds, $options);
    }

    /**
     * Remove tag from images.
     *
     * @param string $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function removeTag($tag, $publicIds = [], $options = [])
    {
        return $this->getUploader()->remove_tag($tag, $publicIds, $options);
    }

    /**
     * Replace image's tag.
     *
     * @param string $tag
     * @param array $publicIds
     * @param array $options
     * @return mixed
     */
    public function replaceTag($tag, $publicIds = [], $options = [])
    {
        return $this->getUploader()->replace_tag($tag, $publicIds, $options);
    }


}
