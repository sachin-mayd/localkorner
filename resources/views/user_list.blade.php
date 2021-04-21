@include('header');
@include('sidebar');
<div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">User List</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
            <!-- <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success text-white" href="add-new-vendor">Add new vendor</a>
                </div>
            </div>
            </div>
            </div> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach($userList as $value)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $value->fname }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                @if ($value->status == 1)
                                                <td><button class="btn btn-success btn-sm">Active</td>
                                                @else
                                                <td><button class="btn btn-danger btn-sm">Inactive</td>
                                                @endif
                                                <td>
                                                @if ($value->status == 1)
                                                <i class="fa fa-toggle-on" onclick="confirmStatus('{{ $value->id }}',0);"></i>
                                                @else
                                                <i class="fa fa-toggle-on" onclick="confirmStatus('{{ $value->id }}',1);"></i>
                                                @endif
                                                </i></a>
                                                </td>
                                            </tr>
                                        @php
                                        $i++;
                                        @endphp
                                        @endforeach

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
@include('footer');      

<script>
function confirmStatus(userid,status)
   {

     swal({
            title: "Are you sure ?",
            text: "Want to change status of this user !", 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            changeStatus(userid,status);
          } else { 
            swal("","Action cancelled!");
          }
        });
   }
   function changeStatus(userid,status)
   {
      $.ajax({
             url: "{{ route('changestatus') }}",
             type: 'POST',
             data: {
                "_token": "{{ csrf_token() }}",
                 "userid":userid,
                 "status":status
                },
             error: function() {
                swal("OOPS !", "Something is wrong !", "error");
             },
             success: function(data) {
                if(data == "Changed")
                {
                    swal({ title: "",
                         text: "User status changed !",
                         type: "success"}).then(okay => {
                           if (okay) {
                            location.reload();
                          }
                        });
                }
                  else
                  {
                    swal("", "Something is wrong !", "error");
                  }
             }
          });
   }
</script>