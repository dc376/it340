<?php
// default pagination config
$config['pagination']['suffix'] = '?'.http_build_query($_GET, '', '&');
$config['pagination']['per_page'] = 20;
$config['pagination']['num_links'] = 10;
$config['pagination']['next_link'] = 10;
$config['pagination']['full_tag_open'] = '<ul>';
$config['pagination']['full_tag_close'] = '</ul>';
$config['pagination']['next_link'] = '&raquo;';
$config['pagination']['next_tag_open'] = '<li>';
$config['pagination']['next_tag_close'] = '</li>';
$config['pagination']['prev_link'] = '&laquo;';
$config['pagination']['prev_tag_open'] = '<li>';
$config['pagination']['prev_tag_close'] = '</li>';
$config['pagination']['cur_tag_open'] = '<li class="active"><a href="#">';
$config['pagination']['cur_tag_close'] = '</a></li>';
$config['pagination']['num_tag_open'] = '<li>';
$config['pagination']['num_tag_close'] = '</li>';
