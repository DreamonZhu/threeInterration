<?php
/**
 * @Author: admin20150824
 * @Date:   2017-01-23 16:42:17
 * @Last Modified by:   admin20150824
 * @Last Modified time: 2017-01-23 23:48:24
 */
// 接收数据
$citycode = isset($_GET['citycode']) ? $_GET['citycode'] : '';
$flag = isset($_GET['flag']) ? $_GET['flag'] : 0;
$callback = isset($_GET['callback']) ? $_GET['callback'] : '';
//	连接数据库
$link = mysql_connect('localhost','root','root');
if($link){
	mysql_select_db('geography');
	mysql_query('set names utf8');
}
//	判断需要数据类型
if($flag == 0){
	echo '未查到数据！';
	return ;
}elseif($flag == 1){
	//	需要查询省的信息
	$sql = "select name,code from t_address_province";
}elseif($flag == 2){
	//	根据省份查询城市信息
	$sql = "select name,code from t_address_city where pCode = '{$citycode}'";
}elseif($flag == 3){
	$sql = "select name,code from t_address_town where cCode = '{$citycode}'";
}
$res = mysql_query($sql);
// $data = Array();
while($row = mysql_fetch_assoc($res)){
	$data[] = array(
		'name' => $row['name'],
		'code' => $row['code']
	);
}
if($data){
	echo $callback . '(' . json_encode($data) . ')';
}else{
	echo $callback . '(' . '[]'. ')';
}
