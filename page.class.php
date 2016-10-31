<?php 

	  class PageClass
	    {
	    	private $now_page;//当前页
	    	private $all_item;//所有记录条数
	    	private $page_size;//每页展示条数
	    	private $all_page;//所有的页数
	    	private $start_page;//起始页
	    	private $end_page;//结束页
	    	private $str;//拼接字符串用
	    	private $page_url;

	    	function __construct($now_page,$all_item,$page_size,$page_url){
	    		$this->page_url=$page_url;
	    		$this->now_page=$this->numeric($now_page);
	    		$this->all_item=$this->numeric($all_item);
	    		$this->page_size=$this->numeric($page_size);
	    		$this->all_page=ceil(($this->all_item)/($this->page_size));

	    	}
	    		private function url_replace($page){
	    			return str_replace("{page}", $page, $this->page_url);
	    		}

	    		private function all_item(){//总记录
	    			return "总记录:".$this->all_item."条 &nbsp;&nbsp";
	    		}

	    		private function now_page(){
	    			return $this->now_page."/".$this->all_page."页 &nbsp;&nbsp;&nbsp";
	    		}

	    		private function first_page(){//第一页
	    			if (($this->now_page)>1) {
	    				return "<a href=\"".$this->url_replace(1)."\">首页</a>&nbsp;";
	    			}else{
	    				return "首页&nbsp;";
	    			}
	    		}

	    		private function prev_page(){//上一页
	    		if (($this->now_page)>1) {
	    			return "<a href=\"".$this->url_replace($this->now_page-1)."\">上一页</a>&nbsp;";
	    		}else{
	    			return "上一页&nbsp;";
	    		}
	    		}

	    		private function pages(){//显示页码
	    				$this->start_page=($this->now_page)-2;
	    				$this->end_page=($this->now_page)+2;
	    				if (($this->start_page)<1) {
	    					$this->start_page=1;
	    				}
	    				if (($this->end_page)>($this->all_page)) {
	    					$this->end_page=$this->all_page;
	    				}
	    			for ($i=($this->start_page); $i<=($this->end_page); $i++) { 
	    				$this->str.="<a href=\"".$this->url_replace($i)."\" title=\"第".$i."页\">".$i."</a>&nbsp";
	    			}
	    			return $this->str;
	    		}

	    		private function next_page(){//下一页
	    		if (($this->now_page)<($this->all_page)) {
	    			return "<a href=\"".$this->url_replace($this->now_page+1)."\">下一页</a>&nbsp;";
	    		}else{
	    			return "下一页&nbsp;";
	    		}
	    		}

	    		private function last_page(){//尾页
	    			if (($this->now_page)<($this->all_page)) {
	    				return "<a href=\"".$this->url_replace($this->all_page)."\">尾页</a>&nbsp;";
	    			}else{
	    				return "尾页";
	    			}
	    		}

				private function numeric($id){//取正整数
		 		if (is_numeric($id)) {
		 			if ($id>0&&$id<=10000000) {
		 				return $id;
		 			}else{
		 				$id=1;
		 				return $id;
		 			}
		 		}else{
		 			$id=1;
		 			return $id;
		 		}
		 	}

		 	function write(){
		 		echo $this->now_page."<br>";
		 		echo $this->all_item."<br>";
		 		echo $this->page_size."<br>";
		 		echo $this->all_page."<br>";
		 		echo $this->all_item();
		 		echo $this->now_page();
		 		echo $this->first_page();
		 		echo $this->prev_page();
		 		echo $this->pages();
		 		echo $this->next_page();
		 		echo $this->last_page();
		 		
		 	}
		}
/*示例*/
/*	  $page=new PageClass(3,1001,10,'index.php?page={page}');
	  $page->write();*/

 ?>