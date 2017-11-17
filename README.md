WoCenter 介绍
-------------

>   WoCenter是基于php Yii2开发的一款优秀的**易扩展**和**高可定制**的开源框架。

WoCenter在设计之初就非常重视二次开发的**便捷性**、**易用性**和**低干扰性**。WoCenter致力于解决这一问题，
为开发者提供一个省心好用且对二次开发更友好的底层框架，在保留Yii2原有操作习惯的基础上，开发出一系列WoCenter特有的特性，
如**Service服务层**、**Dispatch调度层**和**扩展机制**等，**而易于扩展和重构的系统设计有助于你定制出称心如意的项目**。

WoCenter遵循[BSD-3-Clause协议](https://github.com/Wonail/wocenter/blob/master/LICENSE)，意味着你可以免费的部署你的线上项目。

WoCenter 作者微信：234251232

WoCenter QQ群：573142468

WoCenter Github地址: https://github.com/Wonail/wocenter.git

推荐项目
-------------

[WoCenter Advanced](https://github.com/Wonail/wocenter_advanced)是基于WoCenter开发的一款优秀的**高度可扩展**的高级项目模板。

>   WoCenter Advanced充分利用和发挥了WoCenter的所有特性，基于WoCenter的**扩展机制**，
系统核心模块和默认主题均使用扩展中心提供的扩展插件来满足系统的高定制化需求。你可以根据需要自由开发私有或公有的扩展，
也可以使用其他开发者的扩展来定制你的业务系统，避免重复造轮子，开箱即用。

WoCenter 文档
-------------

**权威指南：** [WoCenter 权威指南](http://www.wonail.com/doc/guide)

架构特色
-----------

- Service服务层

    Service服务层的目的在于进一步解耦Model层，让Model层只专注于CRUD、规则验证、数据库映射等简单操作，
**降低Model和业务逻辑的耦合性**，方便日后业务发展可灵活定制Model底层，
而其余复杂的业务逻辑则交由Service层为系统提供实际的功能使用接口。

- Dispatch调度层

    传统的MVC设计模式中，`C`(Controller)负责响应路由请求并从所需的`M`(Model)中获取数据接着由`V`(View)渲染所需的视图文件，
每个层级各司其职，这是一种很好的设计模式，能够使各层级职能分配清楚，极大的解耦各层级的关联性而又不损害其所需的相关性。

    然而，在WoCenter实际开发的过程中，在应对真正多主题或高个性化定制的情况下，传统设计模式并不能很好地满足需求，
故在传统设计模式中的`C`和`V`之间新增一个调度层(**Dispatch**，简称`D`)，用以进一步解藕细分`C`，
同时为二次开发提供更高的**友好性**和**适用性**。

    有时面对`C`复杂的操作设计，会导致`C`方法量或单个操作代码过多，这与瘦控制器胖模型的设计背道而驰，
而`D`则可以有效地把复杂的设计解藕分离出来，针对单个操作提供专属的`D`，实现一对一的关系，方便管理，同时起到瘦控制器的作用，
并可**使控制器与主题相关性不强**，满足系统较高的可定制化需求。

- 扩展机制

    目前提供了一套以主题、模块、功能等为分类的扩展规范，开发者按此规范可自由开发私有或公有的扩展，
也可以使用其他开发者的扩展来定制你的业务系统，而这一切的操作如同搭积木一样简单便捷，
开发者仅需简单进行**安装、卸载和升级**等操作即可完成。

- 重写机制

    得益于Yii2优秀的设计，使得开发者可以非常简单地对系统几乎所有核心文件进行重构或个性化修改（通过classMap类映射，
该方法主要是通过配置文件方式进行覆盖重写），而对于控制器操作、视图文件、资源文件等的修改，都可以更简单地通过**复制、粘贴、修改**来完成
（无需任何配置），这一切的基础都源于WoCenter的**调度层**和**扩展机制**特性。

- 低干扰

    WoCenter以composer包方式安装，故核心文件存放于`vendor/wonail/wocenter`路径，和开发者路径完全隔离，
使得系统后期的升级实现最小化干扰，几乎不对开发者有任何影响。而升级WoCenter核心系统方面，只需简单的`composer update`即可。

- 完善的文档注释和IDE代码提示

    系统核心功能做了大部分的文档注释以及对IDE的友好支持，很大程度上利于开发者的二次开发。
