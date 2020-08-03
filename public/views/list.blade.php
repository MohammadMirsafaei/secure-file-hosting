<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <title>لیست فایل‌ها</title>
  <link href="{{$static}}/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{$static}}/css/vazir-font.css" rel="stylesheet">
  <link href="{{$static}}/css/font-awesome.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="./"><i class="fa fa-folder"></i>مدیریت فایل ها</a> <button aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbar" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./add_user"><i class="fa fa-plus"></i> افزودن کاربر جدید</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./change_password"><i class="fa fa-key"></i> تغییر رمز عبور</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout"><i class="fa fa-sign-out"></i> خروج</a>
        </li>
      </ul>
    </div>
    <div class="my-2 my-lg-0" >
	  <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="nav-link mr-sm-2" >{{$user->username}} <i class="fa fa-user"></i> </div>
        </li>
      </ul>
    </div>
  </nav>
  <main class="container" style="margin-top: 100px">
    <h1 class="font-weight-bold">لیست فایل ها</h1>
    
    <div class="mt-4">
      <a href="./add_file" class="btn btn-dark"><i class="fa fa-plus"></i> فایل جدید</a>
    </div>
    <table class="table mt-5 mb-5">
      <thead>
        <tr>
          <th scope="col">نام</th>
          <th scope="col">سطح محرمانگی</th>
	  <th scope="col">سطح صحت</th>
          <th scope="col">عملیات</th>
        </tr>
      </thead>
      <tbody>
        <?php
		foreach ($files as $file) {
	?>
        <tr>
          <td><i class="'fa fa-file-word-o'"></i> <a dir="ltr" href="<?php echo "./read_file?id=".$file->id ?>" class="text-dark">{{ $file->name }}</a></td>
           <td dir="ltr">{{ $file->confLevel }}</td>
	   <td dir="ltr">{{ $file->integLevel }}</td>
          <td>
            
            <a href="<?php echo "./delete_file?id=".$file->id ?>" class="text-dark"><i class="fa fa-trash"></i></a>
            <a href="<?php echo "./edit_file?id=".$file->id ?>" class="text-dark"> <i class="fa fa-edit"></i></a>
            
          </td>
        </tr>
        <?php
		}
	?>
      </tbody>
    </table>
  </main>
  <script src="{{$static}}/js/jquery-3.5.1.slim.min.js"></script>
  <script src="{{$static}}/js/bootstrap.bundle.min.js"></script>
</body>
</html>
