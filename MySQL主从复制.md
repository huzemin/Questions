MySQL 主从复制
--------------------

## 设备

可以使用虚拟机进行测试：需要两个装有MySQL环境的虚拟机，必须是网络互通。

## 配置文件修改

* Master: 

修改/etc/mysql/my.cnf:在`[mysqld]`下添加以下配置
官方说明：为了使用事务的InnoDB在复制中最大的持久性和一致性，你应该指定innodb_flush_log_at_trx_commit=1,sync_binlog=1选项。

    log-bin
    server-id=1  # master 标识
    binlog-do-db=xx  # 同步数据库
    innodb_flush_log_at_trx_commit=1
    sync_binlog=1

* Slave: 

修改/etc/mysql/my.cnf: 在`[mysqld]`下添加以下配置:
    
    server-id=2 #slave的标示

主从服务器都需要进行重启，可以通过以下命令查看mysql状态:
    
    show master status\G;
    show slave status\G;

## MySQL命令

Master 新建同步账号

```sql
    grant replication slave on *.* to '帐号' @ '从服务器IP' identified by '密码';  
```

Slave 设置同步操作

```sql
    change master to  
    master_host = 'Master服务器IP',  
    master_user = '帐号',  
    master_password = '密码',  
    master_log_file = '同步Log文件名',  
    master_log_pos = '同步Log文件位置';  
    
    slave start;  
```

[http://blog.chinaunix.net/uid-26610882-id-4083396.html](文章)
