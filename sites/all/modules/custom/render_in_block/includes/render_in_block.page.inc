
<?php

  function render_in_block_page()
  {
    $data = block_render('render_in_block','my_block_page');
    return $data;
  }

  function block_render($module,$block_id)
  {
    $block_renderable_array = get_block($module,$block_id);
    return render($block_renderable_array);
  }

  function get_block($module,$block_id)
  {
    $block = block_load($module,$block_id);
    $block->region = 'none';
    $region_blocks = _block_render_blocks([$block]);
    $block_renderable_array = _block_get_renderable_array($region_blocks);
    return $block_renderable_array;
  }