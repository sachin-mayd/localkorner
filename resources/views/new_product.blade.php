@include('header');
@include('sidebar');
@if( $id != '')
    @foreach($product as $value)
        @php 
            $id = $value['id'];
            $product_name = $value['product_name'];
            $vendor_id = $value['vendor_id'];
            $category_id = $value['category_id'];
            $subcategory_id = $value['subcategory_id'];
            $sub_subcategory_id = $value['sub_subcategory_id'];
            $product_description = $value['product_description'];
            $product_type = $value['product_type'];
            $image = $value['product_image'];
            $stock = $value['stock'];
            $price = $value['price'];
            $offer_price = $value['offer_price'];
            $color = $value['color'];
            $size = $value['size'];
            $unit = $value['unit'];
            $status = $value['status'];
        @endphp
    @endforeach
@else
    @php 
            $id ='';
            $product_name ='';
            $vendor_id ='';
            $category_id ='';
            $subcategory_id ='';
            $sub_subcategory_id ='';
            $product_description ='';
            $product_type ='';
            $stock ='';
            $price ='';
            $offer_price ='';
            $color ='';
            $size ='';
            $unit ='';
            $status ='';
            $image = '';
    @endphp
@endif
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Product Info</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add new product</li>
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
                            <form class="form-horizontal" action="{{ route('update-product') }}" method="post" enctype="multipart/form-data">
                            @else
                            <form class="form-horizontal" action="save-product" method="post" enctype="multipart/form-data">
                            @endif
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 text-right control-label col-form-label">Product name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name Here" value="{{ $product_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="vendor_id" class="col-sm-3 text-right control-label col-form-label">Vendor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="vendor_id">
                                            <option value="">Select Vendor</option>
                                                @foreach($vendor as $ven)
                                                <option value="{{$ven->id}}" @if($ven->id == $vendor_id) selected @endif>{{$ven->vendor_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category_id" onchange="getsubcategorydropdown(this.value);">
                                            <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}" @if($cat->id == $category_id) selected @endif>{{$cat->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sub_category_id" class="col-sm-3 text-right control-label col-form-label">Subcategory</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="sub_category_id" id="subcategory" onchange="getsubsubcategorydropdown(this.value);">
                                            <option value="">Select Subcategory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sub_subcategory_id" class="col-sm-3 text-right control-label col-form-label">Sub subcategory</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="subsubcategory" name="sub_subcategory_id">
                                            <option value="">Select Sub subcategory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product_type" class="col-sm-3 text-right control-label col-form-label">Product type</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="product_type">
                                                @foreach($productType as $pt)
                                                <option value="{{$pt->id}}" @if($pt->id == $product_type) selected @endif>{{$pt->product_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="stock" class="col-sm-3 text-right control-label col-form-label">Stock</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ $stock }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="price" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{ $price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="offer_price" class="col-sm-3 text-right control-label col-form-label">Offer price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="offer_price" name="offer_price" placeholder="Offer Price" value="{{ $offer_price }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="color" class="col-sm-3 text-right control-label col-form-label">Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="color" name="color" placeholder="Color" value="{{ $color }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="size" class="col-sm-3 text-right control-label col-form-label">Size</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                <input type="text" class="form-control" id="size" name="size" placeholder="Size" value="{{ $size }}">
                                                </div>
                                                <div class="col-sm-6">
                                                <select class="form-control" id="unit" name="unit">
                                                <option value="">Select Unit</option>
                                                @foreach($product_unit as $uni)
                                                <option value="{{$uni->id}}" @if($uni->id == $unit) selected @endif>{{$uni->unit}}</option>
                                                @endforeach
                                            </select>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label for="product_description" class="col-sm-3 text-right control-label col-form-label">Product description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="product_description" name="product_description" placeholder="Product description">{{ $product_description }}</textarea>
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
                                            <input type="file" name="file" class="form-control" onchange="readURL(this)" multiple>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="imageDiv">
                                    <img id="proimage" class="proimage" src="{{ URL::asset('/product_image' )}}/{{$image}}" alt="your image" style="width: 200px;height: 200px;" />
                                    </div>
                                    <input type="hidden" value="{{$id}}" name="hidden_id" class="form-control">
                                    <input type="hidden" value="{{$image}}" name="hidden_image" class="form-control">
                                    <input type="hidden" value="{{$category_id}}" id="hidden_category_id" class="form-control">
                                    <input type="hidden" value="{{$subcategory_id}}" id="hidden_subcategory_id" class="form-control">
                                    <input type="hidden" value="{{$sub_subcategory_id}}" id="hidden_subsubcategory_id" class="form-control">
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
$( document ).ready(function() {
    var hidden_category_id = $('#hidden_category_id').val();
    var hidden_subcategory_id = $('#hidden_subcategory_id').val();
    getsubcategorydropdown(hidden_category_id);
    getsubsubcategorydropdown(hidden_subcategory_id);
});
function getsubcategorydropdown(category_id)
 {
    var sub_category_id = $('#hidden_subcategory_id').val();

    $.ajax({
        type:'POST',
        url:"{{ route('getsubcategory') }}",
        data:{ 
            "_token": "{{ csrf_token() }}",
            "category_id": category_id
             },
        success:function(response) {
            var subcategory = $.parseJSON(response);
            var html = `<option>Select Subcategory</option>`;
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
 function getsubsubcategorydropdown(subcategory_id)
 {
    var hidden_subcategory_id = $('#hidden_subsubcategory_id').val();

    $.ajax({
        type:'POST',
        url:"{{ route('getsubsubcategory') }}",
        data:{ 
            "_token": "{{ csrf_token() }}",
            "subcategory_id": subcategory_id
             },
        success:function(response) {
            var subsubcategory = $.parseJSON(response);
            var html = `<option>Select Sub Subcategory</option>`;
            $.each( subsubcategory, function( key, val ) {
                if (hidden_subcategory_id == val.id) {
                    var selected = "selected";
                }
                else
                {
                    var selected = "";
                }
                html += `<option value="`+val.id+`" `+selected+`>`+val.undersubcategory+`</option>`
            });
            $("#subsubcategory").html(html);
        }
    });
 }
</script>