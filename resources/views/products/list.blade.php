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

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href={{ route('products.create') }} class="btn btn-dark mb-2">Create</a>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif

            <div class="col-md-10">
                <div class="card border-10 shadow-lg">

                    <div class="card-header bg-dark text-white">
                        <h4>All Products</h4>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>

                            @if ($products->isNotEmpty())

                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            @if ($product->image != '')
                                                <img width="50"
                                                    src="{{ asset('uploads/products/' . $product->image) }}"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->price }} Rs</td>
                                        <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href={{ route('products.edit', $product->id) }}
                                                class="btn btn-dark">Edit</a>

                                            <form action={{ route('products.delete', $product->id) }} method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>

                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            @endif

                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>



{{-- In Laravel, the @method('DELETE') directive is used within a form to specify the HTTP method as DELETE, even though the
form's method attribute is set to POST. This is because HTML forms only support GET and POST methods directly, but
Laravel uses a hidden input field to spoof other HTTP verbs such as PUT, PATCH, and DELETE. --}}
