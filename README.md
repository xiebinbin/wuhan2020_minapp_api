# 目录说明
```
/app/Models/** # 数据模型
/app/GraphQL/Mutations # 数据更新接口
/app/GraphQL/Queries # 数据查询接口
/graphql/*.graphql #gql文件(接口描述)
```
# 常用文档
<p><a href="https://learnku.com/docs/laravel/6.x">Laravel</a></p>
<p><a href="https://graphql.cn/">GraphQL</a></p>
<p><a href="https://lighthouse-php.com/">GraphQL库</a></p>
<p><a href="https://gitee.com/xiebinbin/thunderbolt_charging_api">参考项目</a></p>

# 任务列表
<a href="./task.md">查看</a>
# 运行环境要求
php>=7.2
MySQL>=5.5

# 运行步骤
1.安装
```
composer install 安装依赖库
cp .env.example .env

```
2.配置
```
# 编辑 .env 配置数据库
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
3.配置数据库相关信息
```
php artisan key:generate
p-7u？hp artisan migrate #初始化数据库














































```
4.passport配置
```
php artisan passport:install
# 根据安装信息配置.env
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET=9Sq6i4OwsGBPyHUNkLqSdhzUhm95LxE9eFzmpc5X
# 安装个人令牌
809
# 配置.env
PERSONAL_ACCESS_CLIENT_ID=
```
# 配置阿里云短信配置 .env
```
ALIYUN_ACCESS_KEY_ID=
ALIYUN_ACCESS_KEY_SECRET=
```
# 配置阿里云OSS .env
```
OSS_ACCESS_ID=
OSS_ACCESS_KEY=
OSS_ACCESS_BUCKET=
OSS_ACCESS_ENDPOINT=
```
5.运行调试
```
php artisan serve
```