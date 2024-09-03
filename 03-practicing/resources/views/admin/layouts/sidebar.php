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
              <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{aurl('dashboard')}}">
                <svg class="bi"><use xlink:href="#house-fill"/></svg>
                {{trans('admin.dashboard')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{aurl('categories')}}">
                <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                <i class="fa-solid fa-list-ul"></i>
                {{trans('admin.categories')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{aurl('news')}}">
                <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                <i class="fa-regular fa-newspaper"></i>
                {{trans('admin.news')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{aurl('comments')}}">
                <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                <i class="fa-regular fa-comments"></i>
                {{trans('main.comment')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{aurl('users')}}">
                <svg class="bi"><use xlink:href="#file-earmark"/></svg>
                <i class="fa-regular fa-user"></i>
                  {{trans('admin.users')}}
              </a>
            </li>

          <hr class="my-3">

          <ul class="nav flex-column mb-auto">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="#">
                <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                <i class="fa-solid fa-gear"></i>
                  Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2" href="{{ url('admin/logout')}}">
              <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
              <i class="fa-solid fa-arrow-right-from-bracket"></i> 
              {{trans('admin.logout')}}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>