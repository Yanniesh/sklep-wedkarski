@extends('layouts.app')

@section('content')
    <div class="Flex">
        <form class="FormCenter" action="{{ route('product.update',['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="labelXinput">
                <label for="name">Nazwa:</label>
                <input class="form-control" type="text" id="name" name="name"  value="{{ $product->name }}" required>
            </div>

            <div class="labelXinput">
                <label for="description">Opis:</label>
                <input class="form-control" type="text" id="description" name="description" value="{{ $product->description }}" required>
            </div>

            <div class="labelXinput">
                <label for="price">Cena:</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" required >
            </div>

            <div class="labelXinput">
                <label style="font-size: 2rem;" for="categorySelect">Wybierz kategorię:</label>
                <select id="categorySelect" name="categorySelect">
                    <option value="0" disabled>Wybierz kategorie </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
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


                    @foreach($product->photos as $photo)
                        <div class="productDesc" style="max-width: 20vw;">
                        <form method="POST" action="{{route('productPhoto.destroy', $photo->id)}}">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <img class="" src="http://127.0.0.1:8000/{{$photo->path}}" alt="img">
                            <button class="save_order_button">Usuń zdjecie </button>
                        </form>
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
