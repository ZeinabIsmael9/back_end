<?php
view('admin.layouts.header', ['title' => trans('main.comment')]);
//$comments = db_paginate($GLOBALS['connect'], 'comment', '', 10);
$comments = db_paginate(
    $GLOBALS['connect'],
    'comment',
    "JOIN news ON comment.news_id = news.id",    12,
    "desc",
    "comment.id,comment.name, comment.email, comment.status, comment.comment, news.title as title",

);
?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><?php echo trans('main.comment') ?></h2>
    </div>
    <div class="table-responsive small">

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo  trans('comment.name') ?></th>
                    <th scope="col"><?php echo  trans('comment.news')  ?></th>                    <th scope="col"><?php echo  trans('comment.email') ?></th>
                    <th scope="col"><?php echo  trans('comment.comment') ?></th>
                    <th scope="col"><?php echo  trans('comment.status') ?></th>
                    <th scope="col"><?php echo  trans('admin.action') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php while ($comment = mysqli_fetch_assoc($comments['query'])): ?>
                        <td><?php echo  $comment['id']  ?></td>
                        <td><?php echo  $comment['name']  ?></td>
                        <td><?php echo  $comment['title']  ?></td>
                        <td><?php echo  $comment['email']  ?></td>
                        <td><?php echo  $comment['comment']  ?></td>
                        <td><?php echo  trans('comment.'.$comment['status'])  ?></td>
                        <td>
                            <a href="<?php echo  aurl('comments/show?id='.$comment['id'])  ?>"><i class="fa-regular fa-eye"></i></a>
                            <a href="<?php echo  aurl('comments/edit?id='.$comment['id'])  ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <?php echo delete_record(aurl('comments/delete?id='.$comment['id'])) ?>                        </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <?php echo $comments['render'] ?>
    </div>
<?php
view('admin.layouts.footer');
?>