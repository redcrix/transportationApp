@extends('layouts.app')

@section('content')
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
  
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transportation Users list </h1>
          </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a  href = "{{'/register'}}"><button type="button" class="btn btn-primary">Add New</button></a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach ($users as $user)
                <tr>

                  <td></td>
                  <td>{{ $user->first_name }}</td>
                  <td>{{ $user->last_name }}</td>
                  <td> {{ $user->email}}</td>
                  <td>{{ $user->phone }}</td>
                  <td>{{ $user->address }}</td>
                  <td>{{ $user->gender}}</td>
                  <td><a  href = '/userdata/edituser/{{ $user->id }}'><button type="button" class="btn btn-primary">Edit</button></a> 
                    <a href = '/userdata/{{ $user->id }}'><button type="button" class="btn btn-danger">Delete</button></a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
               <tr>
                  <th>S.No</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Mobile Number</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
     @endsection

     