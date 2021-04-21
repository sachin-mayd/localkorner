@include('header');
@include('sidebar');
@if( $id != '')
    @foreach($vendor as $value)
        @php 
            $id = $value['id'];
            $vendor_name = $value['vendor_name'];
            $company_name = $value['company_name'];
            $email = $value['email'];
            $password = $value['password'];
            $mobile = $value['mobile'];
            $alternate_mobile = $value['alternate_mobile'];
            $address = $value['address'];
            $city = $value['city'];
            $state = $value['state'];
            $zip = $value['zip'];
            $service_description = $value['service_description'];
            $status = $value['status'];
        @endphp
    @endforeach
@else
    @php 
            $id = '';
            $vendor_name = '';
            $company_name = '';
            $email = '';
            $password = '';
            $mobile = '';
            $alternate_mobile = '';
            $address = '';
            $city = '';
            $state = '';
            $zip = '';
            $service_description = '';
            $status = '';
    @endphp
@endif
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Vendor Info</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new vendor</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            @if( $id != '')
                            <form class="form-horizontal" action="{{ route('update-vendor') }}" method="post" enctype="multipart/form-data">
                            @else
                            <form class="form-horizontal" action="save-vendor" method="post" enctype="multipart/form-data">
                            @endif
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="vendor_name" class="col-sm-3 text-right control-label col-form-label">Vendor Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Vendor Name Here" value="{{ $vendor_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company_name" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name Here" value="{{ $company_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Here" value="{{ $email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="password Here" value="{{ $password }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-3 text-right control-label col-form-label">Mobile</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Here" value="{{ $mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alternate_mobile" class="col-sm-3 text-right control-label col-form-label">Alternate Mobile</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="alternate_mobile" name="alternate_mobile" placeholder="Alternate Mobile Here" value="{{ $alternate_mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address Here" value="{{ $address }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 text-right control-label col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City Here" value="{{ $city }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="state" class="col-sm-3 text-right control-label col-form-label">State</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="state" name="state" placeholder="State Here" value="{{ $state }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="zip" class="col-sm-3 text-right control-label col-form-label">Zip</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip Here" value="{{ $zip }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="service_description" class="col-sm-3 text-right control-label col-form-label">Service Description</label>
                                        <div class="col-sm-9">
                                        <textarea class="form-control" name="service_description" id="service_description" placeholder="Service Description Here">{{$service_description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                            <option value="1" @if($status == "1") selected @endif>Active</option>
                                            <option value="0" @if($status == "0") selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$id}}" name="hidden_id" class="form-control">
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
@include('footer');     
