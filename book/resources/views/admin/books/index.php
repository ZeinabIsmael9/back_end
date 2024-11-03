<?php
view('admin.layouts.header', ['title' => trans('admin.books')]);

$books_list = db_paginate(
    $GLOBALS['connect'],
    'book',
    "JOIN categories ON book.category_id = categories.id", 2,
    "asc",
    "book.title,
    book.content,
    book.category_id,
    book.created_at,
    book.updated_at,
    book.image,
    book.description,
    book.id,
    categories.name as category_name"
);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2> <?php echo trans('admin.books') ?></h2>
    <a class="btn btn-primary" href=" <?php echo aurl('books/create') ?>"> <i class="fa-solid fa-plus"></i>  <?php echo trans('admin.add') ?> </a>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"> <?php echo trans('books.title') ?></th>
                <th scope="col"> <?php echo trans('books.category_id') ?></th>
                <th scope="col"> <?php echo trans('books.image') ?></th>
                <th scope="col"> <?php echo trans('admin.created_at') ?></th>
                <th scope="col"> <?php echo trans('admin.updated_at') ?></th>
                <th scope="col"> <?php echo trans('admin.action') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($books = mysqli_fetch_assoc($books_list['query'])): ?>
            <tr>
                <td> <?php echo $books['id'] ?? '' ?></td>
                <td> <?php echo $books['title'] ?? '' ?></td>
                <td><a href=" <?php echo aurl('categories/show?id=' . $books['category_id']) ?>"> <?php echo $books['category_name'] ?? '' ?></a></td>
                <td> <?php echo image(storage_url($books['image'] ?? '')) ?></td>
                <td> <?php echo $books['created_at'] ?? '' ?></td>
                <td> <?php echo $books['updated_at'] ?? '' ?></td>
                <td>
                    <a href=" <?php echo aurl('books/show?id=' . $books['id']) ?>"><i class="fa-regular fa-eye"></i></a>
                    <a href=" <?php echo aurl('books/edit?id=' . $books['id']) ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    <?php echo delete_record(aurl('books/delete?id=' . $books['id'])) ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php echo $books_list['render'] ?? '' ?>
</div>
<?php
view('admin.layouts.footer');
?>
