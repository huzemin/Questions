Linux "/var/lib/mysql is too full" 解决办法
----------------------------------

将/var/lib/mysql 移动到其他目录

### 步骤
1. 将 /var/lib/mysql 复制一份到其他目录，复制的时候要保存 /var/lib/mysql的目录结构。

  `cp -rp /var/lib/mysql /home/mysql`

2. 修改 /etc/mysql/my.cnf

  `datadir= /var/lib/mysql => datadir= /home/mysql`

3. 修改 /etc/apparmor.d/usr.sbin.mysqld
```
/var/lib/mysql/ r,       =>   /home/mysql/ r,
/var/lib/mysql/** rwk,   =>   /home/mysql/** rwk,
```
4. 重启apparmor， 或者直接重启机器

  `/etc/init.d/apparmor restart`

5. 启动mysql 

  `/etc/init.d/mysql start`
