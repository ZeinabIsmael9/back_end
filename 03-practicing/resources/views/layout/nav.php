<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?php echo url('/back_end/03-practicing/'); ?>">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo url('/back_end/03-practicing/'); ?>"><?php echo trans('main.home'); ?> </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo url('/back_end/03-practicing/register'); ?>"><?php echo trans('main.register');?> </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo url('/back_end/03-practicing/login'); ?>"><?php echo trans('main.login'); ?> </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="<?php echo url('/back_end/03-practicing/users'); ?>"><?php echo trans('main.users'); ?> </a>
        </li>
        <li class="nav-item">
          <?php if(session('locale')=='ar') :?>
          <li><a class="nav-link active" href="<?php echo url('/back_end/03-practicing/?lang=en'); ?>"><?php echo trans('main.english'); ?></a></li>
          <?php else: ?>
            <li><a class="nav-link active" href="<?php echo url('/back_end/03-practicing/?lang=ar'); ?>"><?php echo trans('main.arabic'); ?></a></li>
            <?php endif; ?>
          </li>
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
