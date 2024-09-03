<?php
$category = db_find('categories', request('category_id'));
redirect_if(empty($category), url('/'));
$news = db_paginate($GLOBALS['connect'],'news','where news.category_id="'.$category['id'].'"',12);

?>

<?php
view('front.layouts.header', ['title' => $category['name']]);

?>

<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
        <h1 class="display-4 fst-italic"><?= htmlspecialchars($category['name']) ?></h1>
        <p class="lead my-3"><?= htmlspecialchars($category['description']) ?></p>
    </div>
</div>

<div class="row mb-2">
    <?php 
    if ($news && mysqli_num_rows($news['query']) > 0):
        while ($row = mysqli_fetch_assoc($news['query'])):
            // echo "<pre>";
            // print_r($row);
            // echo "</pre>";
        ?>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis"><?= htmlspecialchars($category['name']) ?></strong>
                        <h3 class="mb-0"><?= htmlspecialchars($row['title']) ?></h3>
                        <div class="mb-1 text-body-secondary"><?= htmlspecialchars($row['created_at']) ?></div>
                        <p class="card-text mb-auto"><?= htmlspecialchars($row['description']) ?></p>

                        <a href="<?= url('news?category_id=' . $row['category_id'] . '&id=' . $row['id']) ?>" class="icon-link gap-1 icon-link-hover stretched-link">
                        <?= trans('main.read_more') ?>
                            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <?php
                        if (!empty($row['image'])) {
                            $img = url('storage/' . $row['image']);
                        // } elseif (!empty($category['icon'])) {
                        //     $img = url('storage/' . $category['icon']);
                        } else {
                            $img = url('assets/image/icon.png');
                        }
                        ?>
                        <img src="<?= $img ?>" class="bd-placeholder-img" style="width:200px; height:250px;" />
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>لا توجد أخبار لعرضها.</p>
    <?php endif; ?>
</div>



{{ $news['render'] }}

<?php
view('front.layouts.footer');
?>
