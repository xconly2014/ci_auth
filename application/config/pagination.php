<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $config['page'] = array(
        'page_query_string' => true,
        'use_page_numbers' => true,
        'full_tag_open' => '<ul class="pagination">',
        'full_tag_close' => '</ul>',
        'first_tag_open' => '<li>',
        'first_tag_close' => '</li>',
        'prev_tag_open' => '<li>',
        'prev_tag_close' => '</li>',
        'next_tag_open' => '<li>',
        'next_tag_close' => '</li>',
        'cur_tag_open' => '<li class="active"><a>',
        'cur_tag_close' => '</a></li>',
        'last_tag_open' => '<li>',
        'last_tag_close' => '</li>',
        'num_tag_open' => '<li>',
        'num_tag_close' => '</li>',
        'first_link' => '首页',
        'next_link' => '下一页',
        'prev_link' => '上一页',
        'last_link' => '尾页'
   );