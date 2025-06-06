<div class="container-fluid">
<div class="row">
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="<?php echo aurl('dashboard'); ?>">
                            <svg class="bi">
                                <use xlink:href="#house-fill" />
                            </svg>
                            <?php echo trans('admin.dashboard'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="<?php echo aurl('categories'); ?>">
                            <svg class="bi">
                                <use xlink:href="#file-earmark" />
                            </svg>
                            <i class="fa-solid fa-list-ul"></i>
                            <?php echo trans('admin.categories'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="<?php echo aurl('users'); ?>">
                            <svg class="bi">
                                <use xlink:href="#file-earmark" />
                            </svg>
                            <i class="fa-regular fa-user"></i>
                            <?php echo trans('admin.users'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="<?php echo aurl('books'); ?>">
                        <svg class="bi">
                                <use xlink:href="#file-earmark" />
                            </svg>    
                        <i class="fa-solid fa-book"></i> 
                            <?php echo trans('admin.books'); ?>
                        </a>
                    </li>
                </ul>
                <hr class="my-3">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="<?php echo url('admin/logout'); ?>">
                            <svg class="bi">
                                <use xlink:href="#gear-wide-connected" />
                            </svg>
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <?php echo trans('admin.logout'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
