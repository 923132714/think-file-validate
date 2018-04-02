基于 `Thinkphp5` 开发的文件上传安全验证扩展包。该扩展包为 `Thinkphp5` 提供了一条 `safeFile` 验证规则，具体使用如下。其实 Thinkphp5 为我们提供了 `file`, `fileExt`, `fileMime` 三条规则来验证上传文件的合法性，开发当中的确可以轻松的验证文件名的后缀，但是对文件的 `mime` 类型我们却了解的并不是很多，所以虽然给了我们 `mime` 的验证规则 `fileMime` ,我们还是需要一番时间去搜索相应文件的 `mime` 类型，于是，我就开发了这个包。这个包为我们省去了验证 `mime` 的步骤，只需要我们填写相应的文件后缀它就会自动的去识别该后缀的 `mime` 类型并做判断。

## 安装

```
composer require qsnh/think-file-validate
```

## 使用

```php
$validate = Validate::make([
    'file' => 'safeFile:jpg,png,gif',
]);
if (! $validate->check(request()->file())) {
    var_dump($validate->getError());
}
```

上面的 Demo 是要求上传的文件必须是有效的 `jpg`, `gif`, `png` 图片文件。

## 格式

```
safeFile:文件后缀,文件后缀...
```

## Author 

[Qsnh](https://github.com/Qsnh)