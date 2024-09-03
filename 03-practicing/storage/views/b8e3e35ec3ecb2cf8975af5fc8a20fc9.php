<?php 
$comments = db_paginate($GLOBALS['connect'], 'comment', 'WHERE status="show" and news_id="'.request('id').'"', 15, 'asc', '*', 
    );
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <h5 class="mr-0"><?php echo  trans('main.comment')  ?></h5>
                </div>
                <div class="alert alert-danger error_message d-none"></div>
                <div class="card-body">
                    <form method="post" id="comment_form" action="<?php echo  url('add/comment?news_id=' . request('id'))  ?>">
                        <div class="form-group">
                            <label for="name"><?php echo  trans('main.name')  ?></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="<?php echo  trans('main.name')  ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo  trans('main.email')  ?></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="<?php echo  trans('main.email')  ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="comment"><?php echo  trans('main.write_comment')  ?></label>
                            <textarea id="comment" class="form-control" name="comment" rows="4" placeholder="<?php echo  trans('main.write_comment')  ?>" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block"><?php echo  trans('main.add')  ?></button>
                        <input type="hidden" name="_method" value="post">
                    </form>
                </div>
                <script>
                    $(document).on('submit', '#comment_form', function(e){
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: 'json',
                            beforeSend: function(){
                                $('.error_message').html('').addClass('d-none');
                            },
                            success: function(response) {
                                if(response.status === true){
                                    location.reload();
                                } else {
                                    $('.error_message').html('').addClass('d-none');
                                }
                            },
                            error: function(xhr) {
                                var errors = xhr.responseJSON;
                                if(errors != null){
                                    var error_html = '<ul>';
                                    $.each(errors, function(key, val) {
                                        for(let i = 0; i < val.length; i++){
                                            error_html += '<li>' + val[i] + '</li>';
                                        }
                                    });
                                    error_html += '</ul>';
                                    $('.error_message').html(error_html).removeClass('d-none');
                                }
                            }
                        });
                    });
                </script>
                <div class="card-footer">
                    <?php if($comments && mysqli_num_rows($comments['query']) > 0): ?>
                        <?php while($comment = mysqli_fetch_assoc($comments['query'])): ?>
                            <div class="media mr-3">
                                <img src="https://placehold.co/400" width="50" height="50" class="rounded-circle mr-3" alt="User Image">
                                <div class="media-body">
                                    <h6 class="mt-0 mr-1 d-flex align-items-center">
                                        <span class="mr-2"><?php echo htmlspecialchars($comment['name']); ?></span>
                                    </h6>
                                    <p class="comment-text mr-0"><?php echo htmlspecialchars($comment['comment']); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $comments['render'] ?>