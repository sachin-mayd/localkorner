@include('header');
@include('sidebar');
@if( $id != '')
    @foreach($subcategory as $value)
        @php 
            $id = $value['id'];
            $categoryid = $value['category'];
            $subcategoryid = $value['subcategory'];
            $undersubcategory = $value['undersubcategory'];
            $status = $value['status'];
        @endphp
    @endforeach
@else
    @php 
        $id = '';
        $undersubcategory = '';
        $categoryid = '';
        $status = '';
        $subcategoryid = '';
    @endphp
@endif
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Sub Subcategory Info</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new Sub Subcategory</li>
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
                            <form class="form-horizontal" action="{{ route('update-subsubcategory') }}" method="post" enctype="multipart/form-data">
                            @else
                            <form class="form-horizontal" action="save-subsubcategory" method="post" enctype="multipart/form-data">
                            @endif
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Sub subcategory</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="fname" name="subsubcategory" placeholder="Sub subcategory Name Here" value="{{ $undersubcategory }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category" onchange="getsubcategorydropdown(this.value)">
                                            <option value="">Select Category</option>
                                            @foreach($category as $cat)
                                            <option value="{{$cat->id}}" @if($cat->id == $categoryid) selected @endif>{{$cat->category}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Subcategory</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="subcategory" id="subcategory">
                                            </select>
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
                                    <input type="hidden" value="{{$id}}" name="hidden_id" id="hidden_id" class="form-control">
                                    <input type="hidden" value="{{$categoryid}}" id="hidden_category_id" class="form-control">
                                    <input type="hidden" value="{{$subcategoryid}}" id="hidden_sub_category_id" class="form-control">
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
@include('footer');     
<script>
 
$(document).ready(function() {
    var category_id = $('#hidden_category_id').val();
    if(category_id != ''){
        getsubcategorydropdown(category_id);
    }
});

 function getsubcategorydropdown(category_id)
 {
    var sub_category_id = $('#hidden_sub_category_id').val();

    $.ajax({
        type:'POST',
        url:"{{ route('getsubcategory') }}",
        data:{ 
            "_token": "{{ csrf_token() }}",
            "category_id": category_id
             },
        success:function(response) {
            var subcategory = $.parseJSON(response);
            var html = `<option>Select</option>`;
            $.each( subcategory, function( key, val ) {
                if (sub_category_id == val.id) {
                    var selected = "selected";
                }
                else
                {
                    var selected = "";
                }
                html += `<option value="`+val.id+`" `+selected+`>`+val.subcategory+`</option>`
            });
            $("#subcategory").html(html);
        }
    });
 }
</script>