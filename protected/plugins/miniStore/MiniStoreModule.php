<?php
/**
 * 迷你存储Store
 * @author app <app@miniyun.cn>
 * @link http://www.miniyun.cn
 * @copyright 2015 Chengdu MiniYun Technology Co. Ltd.
 * @license http://www.miniyun.cn/license.html
 * @since 1.8
 */
class MiniStoreModule extends MiniPluginModule { 
    /**
     *
     * @see CModule::init()
     */
    public function init()
    {
        $this->setImport(array(
            "miniStore.biz.*",
            "miniStore.utils.*",
            "miniStore.cache.*",
            "miniStore.models.*",
            "miniStore.service.*",
        ));
        add_filter("plugin_info",array($this, "setPluginInfo"));
        //文件秒传
        add_filter("file_sec",array($this, "fileSec"));
        //文件下载
        add_filter("file_download",array($this, "fileDownload"));
        //图片缩略图
        add_filter("image_path",array($this,"imagePath"));

    }
    /**
     * 获得文件的缩略图
     * @param array $params
     * @return string
     */
    function imagePath($params){
        $signature = $params["signature"];
        $saveFolder = MINIYUN_PATH."/assets/thumbnail/";
        $filePath = $saveFolder.$signature;
        if(!file_exists($filePath)){
            if(!file_exists($saveFolder)){
                mkdir($saveFolder);
            }
            //把文件下载到本地
            $url = PluginMiniStoreNode::getInstance()->getDownloadUrl($signature,"image.jpg","application/octet-stream",1);
            file_put_contents($filePath,file_get_contents($url));
        }
        return $filePath;
    }
    /**
     * 下载文件
     * @param array $params
     * @return string
     */
    function fileDownload($params){
        $signature = $params["signature"];
        $fileName = $params["file_name"];
        $mimeType = $params["mime_type"];
        $forceDownload = $params["force_download"];
        return PluginMiniStoreNode::getInstance()->getDownloadUrl($signature,$fileName,$mimeType,$forceDownload);
    }
    /**
     * 秒传接口
     * @param array $params
     */
    function fileSec($params){  
        $signature = $params["signature"]; 

        $data['success'] = false; 
        $data['store_type'] = "miniStore"; 
        //查询断点文件表
        $node = null;
        $breakFile = PluginMiniBreakFile::getInstance()->getBySignature($signature);
        if(!empty($breakFile)){ 
            $node = PluginMiniStoreNode::getInstance()->getNodeById($breakFile["store_node_id"]); 
        }
        //如果断点文件不存在或无效则重新分配一个存储节点
        if(empty($node)||$node["status"]===-1){
            $node = PluginMiniStoreNode::getInstance()->getUploadNode(); 
            //更新断点表该文件的状态
            PluginMiniBreakFile::getInstance()->create($signature,$node["id"]);
        }
        //回调地址
        $callbackUrl = MiniHttp::getMiniHost()."api.php?node_id=".$node["id"];
        foreach ($params as $key => $value) {
            $callbackUrl .="&".$key."=".$value;
        }
        $data['callback'] =  $callbackUrl;
        $data['node_access_token'] = $node["access_token"]; 
        $data['url'] =  $node["host"]."/api.php";
        echo json_encode($data);exit;
    }
    /**
     *获得插件信息
     * @param $plugins 插件列表
     * {
     *   "miniDoc":{}
     * }
     * @return array
     */
    function setPluginInfo($plugins){
        if(empty($plugins)){
            $plugins = array();
        }
        $storeNode = PluginMiniStoreNode::getInstance()->getUploadNode();
        $data = array(
            "node"=>$storeNode
            );
        array_push($plugins,
            array(
               "name"=>"miniStore",
               "data"=>$data
            ));
        return $plugins;
    }
}
