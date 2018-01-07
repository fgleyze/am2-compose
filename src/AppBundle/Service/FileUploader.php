<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $id = md5(uniqid());
        $extension = $file->guessExtension();

        $fileName = $id . '.' . $extension;
        $file->move($this->getTargetDir(), $fileName);

        $thumbnailName = 'thumb_' . $id . '.' . $extension;

        copy(
            $this->getTargetDir() . '/' . $fileName,
            $this->getTargetDir() . '/' . $thumbnailName
        );

        $this->createThumb($this->getTargetDir(), $thumbnailName);

        return $fileName;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }

    public function getGeometry($fileName)
    {
        $imagick = new \Imagick(realpath($fileName));
        return $imagick->getImageGeometry();
    }

    private function createThumb($projectPath, $image)
    {
        $imagick = new \Imagick(realpath($projectPath . '/' . $image));
        $geometryInfo = $imagick->getImageGeometry();
        if ($geometryInfo['height'] > 500) {
            $imagick->resizeImage(500, intval(500/$geometryInfo['height']), \Imagick::FILTER_LANCZOS, 1);
        }
        $imagick->writeImage();
        $imagick->clear();
        $imagick->destroy();
    }
}
