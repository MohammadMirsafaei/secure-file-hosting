
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
  <title>فایل جدید </title>
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
    <h1 class="font-weight-bold"><i class="fa fa-plus"></i> فایل جدید برای<span dir="ltr">فلان یوزر</span></h1>
    <form method="post">
      <div class="form-group">
        <label for="name">نام فایل</label>
        <input type="text" dir="ltr" class="form-control" name="name" id="name" placeholder="نام فایل" required autofocus>
      </div>
	  <div class="form-row">
		  <div class="form-group col-md-6">
			<label for="confidentiality-lbl">سطح محرمانگی</label>
			<select class="form-control" name="confidentialitylevel" id="confidentiality-lbl">
			  <option>TopSecret</option>
			  <option>Secret</option>
			  <option>Confidential</option>
			  <option>Unclassified</option>
			</select>
		  </div>
		  <div class="form-group col-md-6">
			<label for="integrity-lbl">سطح صحت</label>
			<select class="form-control" name="integritylevel" id="integrity-lbl">
			  <option>VeryTrusted</option>
			  <option>Trusted</option>
			  <option>SlightlyTrusted</option>
			  <option>Unrusted</option>
			</select>
		  </div>
		</div>
      <div class="form-group">
          <label for="content">محتوا</label>
        <textarea dir="ltr" class="form-control" name="content" id="content" rows="10">محتوا</textarea>
      </div>
	  
      <input type="submit" class="btn btn-dark" value="افزودن">
    </form>
  </main>
  <script src="{{$static}}/assets/js/jquery-3.5.1.slim.min.js"></script>
  <script src="{{$static}}/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
