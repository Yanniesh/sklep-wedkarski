@extends('layouts.app')

@section('content')
    <div class="Flex">
        <form class="FormCenter" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="labelXinput">
                <label for="name">Nazwa:</label>
                <input class="form-control" type="text" id="name" name="name" required>
            </div>

            <div class="labelXinput">
                <label for="description">Opis:</label>
                <input class="form-control" type="text" id="description" name="description" required>
            </div>

            <div class="labelXinput">
                <label for="price">Cena:</label>
                <input type="text" class="form-control" id="price" name="price"  required>
            </div>

            <div class="labelXinput">
                <label style="font-size: 2rem;" for="categorySelect">Wybierz kategorię:</label>
                <select id="categorySelect" name="categorySelect">
                    <option value="0" disabled selected>Wybierz kategorię</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="labelXinput">
                <span style="min-width: 40vw; margin: 10px">Maksymalny łączny rozmiar zdjęć to 30MB.</span>
                <input id="file-input" type="file" name="images[]" accept="image/*" multiple onchange="validateFiles(this)">
            </div>


            @if (session('status'))
                <div class="alert alert-success"  style="color:lightgreen;" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <button id="file-submit" class="save_order_button margin-5" type="submit">Save Product</button>
            <p id="file-result" style="color:#ff1818; text-shadow: #1a202c 2px 2px;"></p>
        </form>
        <div class="productDeleteList">
            @foreach($products as $product)
                <div class="product">
                    <div class="productPhoto">
                        @foreach($product->photos->take(2) as $image)
                            <img class="" src="http://127.0.0.1:8000/{{$image->path}}" alt="img">
                        @endforeach
                    </div>
                    <div class="productDesc">
                        <h2>{{ $product->name }}</h2>
                        <form method="POST" action="{{route('product.destroy', $product->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="save_order_button">Usuń produkt</button>
                        </form>
                        <form method="GET" action="{{route('product.edit',$product->id)}}">
                            {{csrf_field()}}
                            {{method_field('GET')}}
                            <button class="save_order_button">Edytuj</button>
                        </form>
                        @if(auth()->user()['role']=="admin")
                            <p>Sprzedawca:   &#160;&#160;{{ $product->owner->name }} </p>
                        @endif
                        <p>Kategoria:   &#160;&#160;{{ $product->category->name }} </p>
                        <p style="color: lightgreen;">Cena:   &#160;&#160;{{ $product->price }}zł</p>
                        <p>Opis: <br>  {{ $product->description }}</p>
                    </div>
                </div>

            @endforeach
        </div>
    </div>


        <script>
            document.getElementById('price').addEventListener('input', function (event) {
                let sanitizedValue = event.target.value.replace(/[^0-9.]/g, '');
                sanitizedValue = sanitizedValue.replace(/([.,].*)[.,]/g, '$1');
                sanitizedValue = sanitizedValue.replace(/(\.\d{2})\d+$/, '$1');
                sanitizedValue = sanitizedValue.replace(/^(\d{7})\d+$/, '$1');
                event.target.value = sanitizedValue;
            });
            let warning = document.getElementById('file-result');
            function validateFiles(input) {
                const maxTotalFileSizeMB = 30;
                warning.innerHTML= "";
                if (input.files.length > 0) {
                    let totalFileSize = 0;

                    for (let i = 0; i < input.files.length; i++) {
                        totalFileSize += input.files[i].size;
                    }

                    const maxTotalFileSizeBytes = maxTotalFileSizeMB * 1024 * 1024;

                    if (totalFileSize > maxTotalFileSizeBytes) {
                        // alert(`Łączny rozmiar plików przekracza ${maxTotalFileSizeMB} MB.`);
                        warning.innerText = `Łączny rozmiar plików przekracza ${maxTotalFileSizeMB} MB.`;
                        input.value = ''; // Wyczyszczenie inputa
                    }
                }
            }
        </script>
@endsection
