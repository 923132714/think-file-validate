<?php

use think\Validate;
use Dflydev\ApacheMimeTypes\PhpRepository;

Validate::extend('safeFile', function ($file, $rules) {
    if (! ($file instanceof \SplFileObject)) {
        return false;
    }

    // 获取上传文件的基本信息
    $extension = strtolower(pathinfo($file->getInfo()['name'], PATHINFO_EXTENSION));
    $mime = (new class {
        public function getMime(\SplFileObject $file)
        {   
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            return finfo_file($finfo, $file->getRealPath() ?: $file->getPathname());
        }
    })->getMime($file);

    // 文件后缀验证
    $rules = array_flip(array_flip(explode(',', $rules)));
    $rules = array_map('strtolower', $rules);
    if (! in_array($extension, $rules)) {
        return false;
    }
    // MIME验证
    $mimes = [];
    $mimeRepository = new PhpRepository;
    foreach ($rules as $rule) {
        $mimeValue = $mimeRepository->findType($rule) ?? [];
        $mimeValue = is_array($mimeValue) ? $mimeValue : [$mimeValue];
        $mimes = array_merge($mimes, $mimeValue);
    }
    if (! in_array($mime, $mimes)) {
        return false;
    }
    return true;
});

Validate::setTypeMsg('safeFile', '请按要求上传文件');