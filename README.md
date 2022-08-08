<h1 align="center"> dahuacloud </h1>

<p align="center"> <a href="https://www.cloud-dahua.com/wiki" target="_blank">大华云睿开放平台</a> </p>

> 需要先熟悉大华云睿开放平台的文档 https://www.cloud-dahua.com/wiki
> 没有特别说明的接口，则需按照文档传递

## Installing

```shell
$ composer require imactool/dahua-cloud -vvv
```


## Usage

```php

    require __DIR__ .'/vendor/autoload.php';
    
    use Imactool\DahuaCloud\Cloud;
    
    $config = [
        'client_id'     => '平台的client_id',
        'client_secret' => '平台的client_secret'
    ];
    
    $cloud = new Cloud($config);
    
    //获取场所管理 的场所列表
    $params = [
        'pageSize' => 10,
        'pageNum'  => 1
    ];
    $res = $cloud->Org->getPlaceList($params);
    var_dump($res);

    //获取业主二维码
    $personFileId = '550970137048096768';
    $res = $dh->Asc->getQrcode($personFileId);
    var_dump($res);


    //社区-混合云三方接口
    $communityCode = '60bd440488654354bc78f46d657ab91b';
    $mixSer = $dh->Mix->mixHeader($communityCode);
    $params = [
        'pageNum' => 1,
        'pageSize' => 20
    ];
    //查询开门记录
    $res = $mixSer->doorOpenRecord($params);
    var_dump($res);


    //云存储 -> 查询通道是否开通云存储
    $params = ['0','1','2']; //设备序列号$通道id 列表
    $res = $dh->Mixed->getStorageStrategy($params);
    var_dump($res);
    
    
    //同步人员授权
    $params =[
        'channelId' => 0,
        'deviceId' => '11dsdsse23432',
        'operateType'=>1,
        'personFileId' => '7634076932312329168'
    ];
    $res = $dh->Asc->syncAuthPersonToDevice($params);
    var_dump($res);
    
    //远程开门
    $params =[
        'accessSource' => 0,
        'type' => 'remote',
        'deviceId' => '11dsdsse23432',
    ];
    $res = $dh->Asc->remoteOpenDoor($params);
    var_dump($res);
    
    
    
    //查询单个设备详情
    $params = [
        'deviceId' =>'11dsdsse23432'
    ];
    $res = $dh->Device->getDeviceInfo($params);
    var_dump($res);
    
    //获取开门计划
    $res = $dh->Asc->getDoorTimePlan();
    var_dump($res);
    
    
    //添加设备
    $params = [
        'storeId' => '2323232323232', //要添加的组织场所id
        'name'   => '监控摄像测试',
        'deviceId' => '11dsdsse23432',
        'devUsername'=>'admin', //设备用户名(使用Base64编码传入,默认为admin) --> 不需要额外处理
        'devPassword'  =>'lc888888' //设备密码(使用Base64编码传入，默认为admin123)--> 不需要额外处理
    ];
    $res = $dh->Device->addDevice($params);
    var_dump($res);
    
    //删除设备
    $deviceId = '11dsdsse23432';
    $res = $dh->Device->deleteDevice($deviceId);
    var_dump($res);
    


```

更多方法，请看源文件（可以使用 请求地址进行搜索匹配接口）


 
## License

MIT