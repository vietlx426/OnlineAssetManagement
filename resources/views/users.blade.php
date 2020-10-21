<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | DataTables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  {{-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="./admin/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->


    <!-- SEARCH FORM -->


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">

          <a href="{{ route('user_logout') }}">Logout</a>
      </li>
      <!-- Notifications Dropdown Menu -->


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>User List</h1>

          </div>
          <div class="col-sm-4">

          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="float-sm-right">


                    <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">


                        <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Create user</button>
                        <button class="btn btn-danger">Report</button>

                      </div>
                    </div>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Staff Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(isset($users))
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                {{$user->staff_code}}
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td> {{$user->email}}</td>
                            <td>
                                @if($user->location == 1)
                                    Ho Chi Minh
                                @else
                                    Hanoi
                                @endif
                            </td>
                            <td>
                                @if($user->type == 1)
                                    <span class="badge badge-success">Admin</span>
                                @else
                                    <span class="badge badge-primary">Staff</span>
                                @endif
                            </td>
                            <td class="text-center">
                            <a href="#sua"
                            data-toggle="modal" data-target="#myModalEdit"
                            onclick="getCapNhat({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{$user->staff_code}}','{{$user->date_of_birth}}'
                            , '{{$user->joined_at}}','{{$user->gender}}','{{$user->type}}'); return false;"
                            >View</a>

                            <a href="{{route('delete.user',$user->id)}}">
                                Delete
                            </a>
                            </td>
                        </tr>
                        @endforeach
                    @endif


                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>
  <form  action="{{ url('/users') }}" method="post">
      @csrf
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Create user</h5>
          <button type="button" class="close" data-di   smiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Name</label>
                  <input type="name" id="name_input" name="name" class="form-control">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Location</label>
                  <select class="form-control select2" style="width: 100%;" name="location" id="location_input">
                    <option selected="selected" value="1">Ho Chi Minh City</option>
                    <option value="2">Hanoi</option>

                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" id="email_input">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Staff Code</label>
                  <input type="" name="staff_code" class="form-control" id="staff_code_input">
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

              <!-- /.col -->
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Type</label>
                  <div class="select2-purple">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="type" id="type1" value="1">
                      <label class="form-check-label" for="type1" >Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                      <label class="form-check-label" for="type2">Staff</label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Date of birth</label>
                  <input type="date" name="date_of_birth" class="form-control" id="date_of_birth_input">
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Join date</label>
                  <input type="date" name="joined_at" class="form-control" id="joined_at_input">
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Gender</label>
                  <div class="select2-purple">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                      <label class="form-check-label" for="gender1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                      <label class="form-check-label" for="gender2">Female</label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary save_user" id="ajaxSubmit">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  </form>

  <!--update/detail user-->
  <form  action="{{ url('/update-user') }}" method="post">
    {{ csrf_field() }}
  <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create user</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Name</label>
                  <input type="hidden" id="ID_edit" name="ID_edit" value="" />

                  <input type="name" name="name" id="name_edit" class="form-control">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Location</label>
                  <select class="form-control select2" style="width: 100%;" name="location">
                    <option selected="selected" value="1">Ho Chi Minh City</option>
                    <option value="2">Hanoi</option>

                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" id="email_edit" class="form-control">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Staff Code</label>
                  <input type="" name="staff_code" id="staff_code_edit" class="form-control" >
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

              <!-- /.col -->
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Type</label>
                  <div class="select2-purple">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="type" id="type_admin_edit" value="1">
                      <label class="form-check-label" for="inlineRadio1">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="type" id="type_staff_edit" value="2">
                      <label class="form-check-label" for="inlineRadio2">Staff</label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Date of birth</label>
                  <input type="date" name="date_of_birth" id="date_of_birth_edit" class="form-control">
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Join date</label>
                  <input type="date" name="joined_at" id="joined_at_edit" class="form-control">
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <div class="col-12 col-sm-12">
                <div class="form-group">
                  <label>Gender</label>
                  <div class="select2-purple">
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="male_edit" value="1">
                      <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="gender" id="female_edit"  value="2">
                      <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  </form>
  <!---->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
{{-- <script src="./admin/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
<!-- jQuery -->
{{-- <script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script> --}}
<script>
    function getCapNhat(id, name, email, staff_code, date_of_birth, joined_at, gender) {
			$('#ID_edit').val(id);
			$('#name_edit').val(name);
			$('#email_edit').val(email);
			$('#staff_code_edit').val(staff_code);
			$('#date_of_birth_edit').val(date_of_birth);
			$('#joined_at_edit').val(joined_at);
            if(gender == 1){
                $("#male_edit").prop("checked", true);
            }
            else{
                $("#female_edit").prop("checked", true);
            }
            if(gender == 1){
                $("#type_admin_edit").prop("checked", true);
            }
            else{
                $("#type_staff_edit").prop("checked", true);
            }

		}
</script>




</body>
</html>
