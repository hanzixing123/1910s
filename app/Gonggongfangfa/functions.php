<?php

	//无限极分类
	    function createTree($list,$parent_id=0,$level=0){
        if(!$list){
            return;
        }
        static $newarray=[];
        foreach($list as $v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newarray[]=$v;
              createTree($list,$v->cate_id,$level+1);
            }
        }
        return $newarray;   
    }
    // 图片
   		  function tupian($img){
        //使用 isValid 方法判断文件在上传过程中是否出错
        if(request()->file($img)->isValid()){
            //接受上传文件
            $file=request()->$img;
            //实现上传
            $path=$file->store("tupian");

            return $path;
        }
        die("上传文件出错!!!!!!!!");
    }
    	//图集
		function tupians($imgs){
        $file=request()->$imgs;
        if(!is_array($file)){
            return;
        }
        foreach($file as $k=>$v){
            $path[$k]=$v->store("tupian");
        }
        return $path;
        die("上传文件出错!");
    }
    function returnjson($code,$msg){
        $data=[
            'code'=>$code,
            'msg'=>$msg
            ];
            echo json_encode($data);die;

    }




