<html>
<head>
    <meta http-equiv="CONTENT-TYPE" content="text/html;charset=utf-8" />
    <title>迷你云访问出错</title>
</head>
<style type="text/css">
    #tip-body{
        margin: auto;
        margin-top:7% ;
        width:600px;
    }
    #tip-title{
        font-size: 30px;
        color:#ffa800;
    }
    .gray{
        color:#656565;
    }
</style>
<body>
<div id="tip-body">
    <img src="<?php echo MiniHttp::getMiniHost()?>static/images/tip-browse.png?v=<?php echo(APP_VERSION)?>"  style="margin-left:120px;"/>
    <p id="tip-title">尊敬的用户，无法访问您的迷你云</p>
    <div class="gray" style="font-size: 24px;">请不要着急，请按下面方法一步一步检测</div>
    <p class="gray"><img src="<?php echo MiniHttp::getMiniHost()?>static/images/circle.png?v=<?php echo(APP_VERSION)?>" width="12px"/><span style="font-size: 18px;">&nbsp;1.请确认，本机浏览器能正常访问<a href="http://static.miniyun.cn" target="_blank">http://static.miniyun.cn</a></span></p>
    <p class="gray"><img src="<?php echo MiniHttp::getMiniHost()?>static/images/circle.png?v=<?php echo(APP_VERSION)?>" width="12px"/><span style="font-size: 18px;">&nbsp;2.清理一下浏览器的cookie缓存，重启浏览器，访问试试。</p>
    <p class="gray"><img src="<?php echo MiniHttp::getMiniHost()?>static/images/circle.png?v=<?php echo(APP_VERSION)?>" width="12px"/><span style="font-size: 18px;">&nbsp;3.如果还不正确，请管理员帮助确认下面2个问题：</span></p>
    <ul  class="gray">
        <li>需要迷你云安装目录下的{protected/runtime}开放写权限</li>
        <li>需要Mysql数据库正常启动，如已成功启动，<a href="<?php echo MiniHttp::getMiniHost()."index.php/db/repair"?>">点击这里修复数据库>></a></li>
    </ul>
    <p class="gray"><img src="<?php echo MiniHttp::getMiniHost()?>static/images/circle.png?v=<?php echo(APP_VERSION)?>" width="12px"/><span style="font-size: 18px;">&nbsp;4.如上述2个方法还没有成功，请访问社区。举报问题，快速解决。<a target="_blank" href="http://bbs.miniyun.cn/forum.php?mod=viewthread&tid=2&extra=page%3D1">点击访问迷你云社区>></a></span></p>
</div>
</body>
</html>
