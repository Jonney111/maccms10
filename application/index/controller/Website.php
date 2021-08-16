<?php
namespace app\index\controller;
use think\Controller;

class Website extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return $this->label_fetch('website/index');
    }

    public function type()
    {
        $info = $this->label_type();
        return $this->label_fetch( mac_tpl_fetch('website',$info['type_tpl'],'type') );
    }

    public function show()
    {
        $this->check_show();
        if($GLOBALS['config']['app']['show_verify'] ==1){
            if(empty(session('show_verify'))){
                $this->assign('type','show');
                return $this->label_fetch('public/verify');
            }
        }
        $info = $this->label_type();
        return $this->label_fetch( mac_tpl_fetch('website',$info['type_tpl_list'],'show') );
    }

    public function ajax_show()
    {
        $this->check_show();
        $info = $this->label_type();
        return $this->label_fetch('website/ajax_show');
    }

    public function search()
    {
        $param = mac_param_url();
        $this->check_search($param);
        if($GLOBALS['config']['app']['search_verify'] ==1){
            if(empty(session('search_verify'))){
                $this->assign('type','search');
                return $this->label_fetch('public/verify');
            }
        }
        if(!empty($GLOBALS['config']['app']['wall_filter'])){
            $param = mac_escape_param($param);
        }
        $this->assign('param',$param);
        return $this->label_fetch('website/search');
    }

    public function ajax_search()
    {
        $param = mac_param_url();
        $this->check_search($param);
        if(!empty($GLOBALS['config']['app']['wall_filter'])){
            $param = mac_escape_param($param);
        }
        $this->assign('param',$param);
        return $this->label_fetch('website/ajax_search');
    }

    public function detail()
    {
        $info = $this->label_website_detail();
        return $this->label_fetch( mac_tpl_fetch('website',$info['website_tpl'],'detail') );
    }

    public function ajax_detail()
    {
        $info = $this->label_website_detail();
        return $this->label_fetch('website/ajax_detail');
    }

    public function rss()
    {
        $info = $this->label_website_detail();
        return $this->label_fetch('website/rss');
    }

    public function saveData()
    {

    }

}
