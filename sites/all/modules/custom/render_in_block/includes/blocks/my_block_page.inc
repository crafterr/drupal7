<?php
function render_in_block_render_block()
{
  $data = [
    'adam','maciek','krzysiek'
  ];
  $block = [];
  $block['content'] = theme('render_in_block_page_block',[
    'data' => $data,
    'subtext' => variable_get('subtext')
  ]);

  return $block;
}