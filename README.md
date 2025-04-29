# **Smplote** :

## summary
    a tiny and simple framework.
    simple time toool and str tool for daily coding.

![首页](public/assets/awork/img/index.png)

> catalog summary ：
```
/---
-----app                 应用文件夹
    |
    -----Console         命令行
    -----Exception       异常处理
    -----Http            前端控制器
    -----Http            监听器
    -----Models          模型文件
    -----Providers       提供器
    -----Service         服务类
-----bootstrap           Bootstrap
-----config              配置文件夹
-----database            数据库文件
-----lang                语言包
-----public              入口文件夹
    |
    -----.htaccess
    -----favicon.ico
    -----index.php       入口文件
-----resources           静态资源
-----routes              路由管理
-----storage
    |
    -----.logs           项目日志
-----tests               自动化测试
-----vendor              自动生成
-----.env.example        环境示例
-----composer.josn       必要依赖
-----README.md           文档说明

```

## quick start
```bash
git clone https://gitee.com/mounten2657/smplote.git

cp .env.example .env
composer install

php artisan key:generate
php artisan serve
```

安装完成：http://127.0.0.1

## License
- 这个项目免费开源，不存在收费。
- 本工具仅供学习和技术研究使用，不得用于任何商业或非法行为。
- 本工具的作者不对本工具的安全性、完整性、可靠性、有效性、正确性或适用性做任何明示或暗示的保证，也不对本工具的使用或滥用造成的任何直接或间接的损失、责任、索赔、要求或诉讼承担任何责任。
- 本工具的作者保留随时修改、更新、删除或终止本工具的权利，无需事先通知或承担任何义务。
- 本工具的使用者应遵守相关法律法规，尊重微信的版权和隐私，不得侵犯微信或其他第三方的合法权益，不得从事任何违法或不道德的行为。
- 本工具的使用者在下载、安装、运行或使用本工具时，即表示已阅读并同意本免责声明。如有异议，请立即停止使用本工具，并删除所有相关文件。
- 代码仅用于对技术的交流学习使用，禁止用于实际生产项目，请勿用于非法用途和商业用途！如因此产生任何法律纠纷，均与作者无关！


