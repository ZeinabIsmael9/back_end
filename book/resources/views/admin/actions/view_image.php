<?php if (!empty($image)):
    $rand = md5(rand(000, 999));
?>
    <!-- Button trigger modal -->
    <img src="<?php echo  $image  ?>" data-bs-toggle="modal" data-bs-target="#showImage<?php echo $rand ?>" style="width: 35px;height: 35px; cursor:pointer;" />
    <!-- Modal -->
    <div class="modal fade" id="showImage<?php echo $rand ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $rand ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="<?php echo  $image  ?>" style="width: 100%;height: 100%;" />
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>