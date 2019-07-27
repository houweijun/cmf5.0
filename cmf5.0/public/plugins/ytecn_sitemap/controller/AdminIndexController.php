<?php
// +----------------------------------------------------------------------
// | YtecnSitemap [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018 Tangchao All rights reserved.
// +----------------------------------------------------------------------
// | Author: Tangchao <admin@ytecn.com>
// +----------------------------------------------------------------------
namespace plugins\ytecn_sitemap\controller;

use cmf\controller\PluginAdminBaseController;
use app\portal\model\PortalCategoryModel;
use app\portal\model\PortalPostModel;
use think\Db;

class AdminIndexController extends PluginAdminBaseController
{

    protected function _initialize()
    {
        parent::_initialize();
        $adminId = cmf_get_current_admin_id();
        if (!empty($adminId)) {
            $this->assign("admin_id", $adminId);
        }
    }

    public function index()
    {
        $request = $this->request;
        $host=$request->domain();
        $this->assign("host", $host);
        return $this->fetch('/admin_index');
    }

    public function addxml()
    {
        $site = $this->siteinfo();
        $html = '<a href="'.$site.'/">首页</a>';
        $lastmod=date('Y-m-d H:i:s',time());
        $xml = '<?xml version="1.0" encoding="utf-8"?><?xml-stylesheet type="text/xsl" href="'.$site.'/plugins/ytecn_sitemap/sitemap.xsl"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0"><url><loc>'.$site.'/</loc><changefreq>daily</changefreq><priority>1</priority><lastmod>'.$lastmod.'</lastmod></url>';
        $portalCategoryModel = new PortalCategoryModel();
        $category = $portalCategoryModel->where('status', 1)->where('delete_time', 0)->select();
        foreach($category as $val)
        {
            $lastmod=date('Y-m-d H:i:s',time());
            $geturl=url('portal/List/index','id='.$val['id'],'html',true);
            $html .= '<a href="'.$geturl.'">'.$val['name'].'</a>'."<br>";
            $xml .= '<url><loc>'.$geturl.'</loc><changefreq>daily</changefreq><priority>0.8</priority><lastmod>'.$lastmod.'</lastmod></url>';
        }
        $PortalPostModel = new PortalPostModel();
        $where['post_status'] = '1';
        $where['post_type'] = '2';
        $article = $PortalPostModel->where($where)->where('delete_time', 0)->select();
        foreach($article as $value)
        {
            $lastmod=date('Y-m-d H:i:s',time());
            $geturl=url('portal/Page/index','id='.$value['id'],'html',true);
            $html .=  '<a href="'.$geturl.'">'.$value['post_title'].'</a>'."<br>";
            $xml .= '<url><loc>'.$geturl.'</loc><changefreq>monthly</changefreq><priority>0.5</priority><lastmod>'.$lastmod.'</lastmod></url>';
        }
        $where['post_status'] = '1';
        $where['post_type'] = '1';
        $article = $PortalPostModel->where($where)->where('delete_time', 0)->select();
        foreach($article as $value)
        {
            $lastmod=date('Y-m-d H:i:s',$value['create_time']);
            $geturl=url('portal/Article/index','id='.$value['id'],'html',true);
            $html .=  '<a href="'.$geturl.'">'.$value['post_title'].'</a>'."<br>";
            $xml .= '<url><loc>'.$geturl.'</loc><changefreq>monthly</changefreq><priority>0.5</priority><lastmod>'.$lastmod.'</lastmod></url>';
        }
        $xml .= '</urlset>';
        $this->updatexml($xml);
        $this->success("生成成功！！");
    }


    private function siteinfo()
    {
        $request = $this->request;
        return $request->domain();
    }
    private function updatetxt($data)
    {
        $this->writefile('txt',$data);
    }
    private function updatexml($data)
    {
        $this->writefile('xml',$data);
    }
    private function writefile($type,$data)
    {
        $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/sitemap.".$type, "w") or die("Unable to open file!");
        fwrite($myfile, $data);
        fclose($myfile);
    }

}
