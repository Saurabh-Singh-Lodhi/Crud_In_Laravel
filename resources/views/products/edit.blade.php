<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud In Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
    * {
        font-family: 'Gilroy';
    }
</style>

<body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Crud in laravel</h3>
    </div>

    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-10 shadow-lg">

                    <div class="card-header bg-dark text-white">
                        <h4>Edit product</h4>
                    </div>

                    <form action={{ route('products.update',$product->id) }} method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="form-label h4">Name</label>
                                <input type="text"
                                    class="@error('name') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Enter name" name="name" value= {{ $product->name }}>
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="form-label h4">SKU</label>
                                <input type="text"
                                    class="@error('SKU') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Enter Sku" name="SKU" value= {{ $product->sku }}>
                                @error('SKU')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="form-label h4">Price</label>
                                <input type="text"
                                    class="@error('price') is-invalid @enderror form-control form-control-lg"
                                    placeholder="Enter price" name="price" value= {{ $product->price }}>
                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="form-label h4">Description</label><br>
                                <textarea name="description" id="" cols="125" rows="4" class="form-control">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image">
                                @if ($product->image != "")
                                    <img src="{{ asset( 'uploads/products/'.$product->image ) }}" alt="">
                                @endif
                            </div>
                            <div class="d-grid">
                                <button name="submit"
                                    class="btn btn-lg form-control bg-dark text-white">Update</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


</body>

</html>
