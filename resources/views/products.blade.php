@extends('layouts.app')

@section('content')
<div class="container">

    <div class="alert alert-success" id="successMessage" style="display: none;" role="alert">
        Product added/updated successfully!
    </div>

    <div class="alert alert-danger" id="errorMessage" style="display: none;" role="alert">
        Error adding/updating product. Please try again.
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form id="productForm">
                @csrf
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="productName">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity in Stock</label>
                    <input type="number" class="form-control" id="quantity" name="quantity">
                </div>
                <div class="form-group">
                    <label for="price">Price per Item</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8 offset-md-2">
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity in Stock</th>
                        <th>Price per Item</th>
                        <th>Datetime Submitted</th>
                        <th>Total Value Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product['productName'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['price'] }}</td>
                        <td>{{ $product['datetime'] }}</td>
                        <td>{{ $product['quantity'] * $product['price'] }}</td>
                        <td>
                            <button class="btn btn-primary edit-btn" data-id="{{ $loop->index }}" data-product="{{ json_encode($product) }}">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="totalValue">
                Total Value: {{ $totalValue }}
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editProductForm">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="editProductId" name="productId">
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="productName">
                    </div>
                    <div class="form-group">
                        <label for="editQuantity">Quantity in Stock</label>
                        <input type="number" class="form-control" id="editQuantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label for="editPrice">Price per Item</label>
                        <input type="number" class="form-control" id="editPrice" name="price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endsection