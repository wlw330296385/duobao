<?php
return array(
    array(
        //父菜单ID，NULL或者不写系统默认，0为顶级菜单
        "parentid" => 0,
        //地址，[模块/]控制器/方法
        "route" => "DuoBao/Index/index",
        //类型，1：权限认证+菜单，0：只作为菜单
        "type" => 1,
        //状态，1是显示，0不显示（需要参数的，建议不显示，例如编辑,删除等操作）
        "status" => 1,
        //名称
        "name" => "夺宝",
        //备注
        "remark" => "",
        //子菜单列表
        "child" => array(
        	array(
                "route" => "DuoBao/Manager/setting",
                "type" => 1,
                "status" => 1,
                "name" => "基本配置",
            ),
            array(
                "route" => "DuoBao/Manager/goods",
                "type" => 1,
                "status" => 1,
                "name" => "商品管理",
                "child" => array(
                    //这里是其它的子菜单
                    "route" => "DuoBao/Manager/goods_add",
	                "type" => 1,
	                "status" => 0,
	                "name" => "添加商品"
                )
            ),
            array(
                "route" => "DuoBao/Manager/orders",
                "type" => 1,
                "status" => 1,
                "name" => "订单管理",
            ),
            array(
                "route" => "DuoBao/Manager/winning",
                "type" => 1,
                "status" => 1,
                "name" => "中奖用户",
            ),
            array(
                "route" => "DuoBao/Manager/shows",
                "type" => 1,
                "status" => 1,
                "name" => "奖品晒单",
            )
        )
    )
);