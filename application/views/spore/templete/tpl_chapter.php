<article>
    <input type="hidden" id="chapter_order" value="<?php echo $chapter->chapter_order; ?>" />
    <div class="title"><?php echo $chapter->chapter_title; ?></div>
    <div class="publish">发布：<?php echo $chapter->create_time; ?></div>
    <section><?php echo $chapter->chapter_content; ?></section>
</article>