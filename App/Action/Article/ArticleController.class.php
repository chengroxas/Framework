<?php

class ArticleController{
	
	public function view(){
		$count=$this->db->count('article','');
		Loader::import('core/Page');
		$pagesize = 2;
		if($count<$pagesize){
			$pagesize=$count;//如果总记录数小于要显示的记录
		}
		$page = new Page($count, $pagesize);
		$html = $page->show("type=1",2, 2);
		$limit = $page->getOffset();
		$rows=$this->db->getList('article','','',"{$limit},{$pagesize}");
		$this->view->assign('link',$html);
		$this->view->assign('article',$rows);
		$ret=$this->view->display('view.html','1');
		echo $ret;
	}
	
	public function delete(){
		$id=$_GET['id'];
		$where="id={$id}";
		$ret=$this->db->delete('article',$where);
		if($ret!=FALSE){
			echo "<script>alert('删除成功');window.history.back();</script>";
		}else{
			echo "<script>alert('删除失败');window.history.back();</script>";
		}
	}
	
}
