<?php
$news = db_frist(
    'news',
    "JOIN categories ON news.category_id = categories.id
    JOIN user ON news.user_id = user.id WHERE news.id = '" . request('id') . "'
    ",
    "news.title,
    news.content,
    news.user_id,
    news.category_id,
    news.created_at,
    news.updated_at,
    news.image,
    news.description,
    news.id,
    user.name as user_name,
    categories.name as category_name"
);
redirect_if(empty($news), url('/'));
// var_dump($news);

?>

<?php
view('front.layouts.header', ['title' => $news['title']]);
?>

<div class="row mb-2">
    <div class="col-md-12">
        <article class="blog-post">
            <h2 class="display-5 link-body-emphasis mb-1">{{ $news['title'] }}</h2>
            <p class="blog-post-meta"> {{ $news['created_at']  }} <span> {{ $news['user_name']  }} </span></p>
            <?php
            if (!empty($news['image'])) {
                $img = url('storage/' . $news['image']);
            } else {
                $img = url('assets/image/icon.png');
            }
            ?>
            <img src="<?php echo $img; ?>" alt="image" class="img-fluid" style="width:300px;max-height:500px;">
            <p> {{ $news['content'] }} </p>
        </article>
        <hr />
        <div class="col-md-12">
            <div class="card">
                {{view('front.categories.comments')}}
            </div>
        </div>
    </div>
</div>

<?php
view('front.layouts.footer');
?>