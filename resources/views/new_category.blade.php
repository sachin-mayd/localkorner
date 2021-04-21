@include('header');
@include('sidebar');
@if( $id != '')
    @foreach($category as $value)
        @php 
            $id = $value['id'];
            $categoryname = $value['category'];
            $image_icon = $value['image_icon'];
            $status = $value['status'];
        @endphp
    @endforeach
@else
    @php 
        $id = '';
        $categoryname = '';
        $image_icon = '';
        $status = '';
    @endphp
@endif
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Category Info</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new category</li>
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
                            <form class="form-horizontal" action="{{ route('update-category') }}" method="post" enctype="multipart/form-data">
                            @else
                            <form class="form-horizontal" action="save-category" method="post" enctype="multipart/form-data">
                            @endif
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" name="category" placeholder="Category Name Here" value="{{ $categoryname }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                            <option value="1" @if($status == "1") selected @endif>Active</option>
                                            <option value="0" @if($status == "0") selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="file" class="form-control" onchange="readURL(this)">
                                        </div>
                                    </div>
                                    <input type="hidden" value="{{$image_icon}}" name="hidden_image" class="form-control">
                                    <input type="hidden" value="{{$id}}" name="hidden_id" class="form-control">
                                    <div class="form-group row" id="imageDiv">
                                    <img id="proimage" class="proimage" src="{{ URL::asset('/category_image' )}}/{{$image_icon}}" alt="your image" style="width: 200px;height: 200px;" />
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
@include('footer');     
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#proimage').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
        $("#imageDiv").removeClass('d-none');
}
</script>