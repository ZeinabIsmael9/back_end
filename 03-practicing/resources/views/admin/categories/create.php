<?php

view('admin.layouts.header', ['title' => trans('admin.categories')]);
$categories = db_paginate($GLOBALS['connect'], 'categories', '', 10);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>{{trans('admin.categories')}} - {{trans('admin.add')}}</h2>
        <a class="btn btn-primary" href="{{aurl('categories.create')}}">{{trans('admin.categories')}}</a>
    </div>

    @if(any_errors())
    <div class="alert alert-danger">
        <ol>
            @foreach(all_errors() as $error)
            <li><?php echo $error; ?></li>
            @endforeach
        </ol>
    </div>
    @endif


    @php
    $name = get_error('name');
    $icon = get_error('icon');
    $description = get_error('description');
    end_errors();
    @endphp

    <form method="post" action="{{aurl('categories/create')}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post">
        <div class="row">
        <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{trans('cat.name')}}</label>
                    <input type="text" class="form-control" id="name" placeholder="{{trans('cat.name')}}"
                        class="form-control <?php echo !empty($name) ? 'is-invalid' : 'is-valid'; ?>"
                        name="name" value="{{old('name')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="icon">{{trans('cat.icon')}}</label>
                    <input type="file" class="form-control" id="icon"  name="icon" placeholder="{{trans('cat.icon')}}"
                        class="form-control <?php echo !empty($icon) ? 'is-invalid' : 'is-valid'; ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">{{trans('cat.description')}}</label>
                    <textarea class="form-control" id="description" name="description" placeholder="{{trans('cat.description')}}"
                    class="form-control <?php echo !empty($description) ? 'is-invalid' : 'is-valid'; ?>"
                    value="{{old('description')}}"> </textarea>
                </div>
                <input type="submit" class="btn btn-success" value="{{trans('admin.add')}}">
            </div>
        </div>
    </form>
</main>
<?php
view('admin.layouts.footer');
?>