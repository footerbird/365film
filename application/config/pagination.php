<?php
	$config['use_page_numbers'] = TRUE; //设置为page为实际的页数而不是偏移量
	
	$config['full_tag_open'] = '<div class="pagination"><ul>';
	$config['full_tag_close'] = '</ul></div>';
	
	$config['first_tag_open'] = '<li class="first">';
	$config['first_tag_close'] = '</li>';
	
	$config['last_tag_open'] = '<li class="last">';
	$config['last_tag_close'] = '</li>';
	
	$config['next_tag_open'] = '<li class="next">';
	$config['next_tag_close'] = '</li>';
	
	$config['prev_tag_open'] = '<li class="pre">';
	$config['prev_tag_close'] = '</li>';
	
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	
	$config['cur_tag_open'] = ' <li class="current"><a>'; // 当前页开始样式   
	$config['cur_tag_close'] = '</a></li>'; 
	
	$config['first_link'] = '首页'; // 第一页显示   
	$config['last_link'] = '末页'; // 最后一页显示   
	$config['next_link'] = '&gt;'; // 下一页显示   
	$config['prev_link'] = '&lt;'; // 上一页显示   
?>