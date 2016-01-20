PHP PDO 使用事务学习记录
---------------

#### 实例代码：

```php
try{
    $conn = new PDO("mysql:host=127.0.0.1;dbname=c9;charset=utf8", 'huzemin8', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $err) {
    echo $err->getMessage();
}

try{
    if($conn->beginTransaction()) {
        $conn->exec('insert into user(id, name, password) value(3, "hello1", "world")');
        $conn->exec('insert into user1(id, name, password) value(2, "hello1", "world")');
    }
    $conn->commit();
} catch(Exception $e) {
    echo $e->getMessage();
    $conn->rollBack();
   
}
```

### 注意

1. 需要检查所在数据库是否支持事务
2. 设置PDO错误抛出模式：`PDO::ERRMODE_SILENT`, `PDO::ERRMODE_EXCEPTION`, `PDO::ERRMODE_WARNING`。

    > *PDO::ERRMODE_SILENT* : 此为默认模式。 PDO 将只简单地设置错误码，可使用 PDO::errorCode() 和 PDO::errorInfo() 方法来检查语句和数据库对象。不进行错误抛出。
    
    > *PDO::ERRMODE_WARNING* : 除设置错误码之外，PDO 还将发出一条传统的 E_WARNING 信息。如果只是想看看发生了什么问题且不中断应用程序的流程，那么此设置在调试/测试期间非常有用。
    
    > *PDO::ERRMODE_EXCEPTION* : 除设置错误码之外，PDO 还将抛出一个 PDOException 异常类并设置它的属性来反射错误码和错误信息。
    
    建议使用`PDO::ERRMODE_EXCEPTION`, 这样则可以通过`try{...}catch(PDOException $e){}`进行错误捕捉，设置事务回滚。 [PDO错误模式详情](http://php.net/manual/zh/pdo.error-handling.php)

    ```php
    PDO::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ```

3. ```PDO::beginTransaction()``` 开启事务； ```PDO::commit()``` 提交事务；```PDO::rollBack()``` 事务回滚！
