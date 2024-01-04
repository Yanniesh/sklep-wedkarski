@extends('layouts.app')

@section('content')
    <div class="contentFlex">
    <div class="div-FormCenter">
        <div style="text-align:center;" class="nav-item">
            <a class="nav-link" style="text-align:center; margin: 0 auto"  href="{{ route('order') }}">Ustal kolejność</a>
        </div>
        <form class="FormCenter" method="post" enctype="multipart/form-data" action="{{ route('slideredit') }}">
            @csrf
                <div class="labelXinput">
                    <label for="caption" class="pad-TB-5">Opis</label>
                    <input id="caption" type="text" class="form-control pad-TB-5" name="caption" required>
                </div>
                <div class="labelXinput">
                    <label class="pad-TB-5" for="image">Wybierz zdjęcie do dodania:</label>
                    <input class="form-control pad-TB-5" type="file" id="image" name="image" accept="image/png, image/jpeg" />
                </div>
                    <button class="margin-5 nav-item">Submit</button>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                     @endif
        </form>
    </div>
    <div class="smallGalleryPick">
        @foreach(App\Models\SliderPhoto::all() as $image)
            <div class="ImgForm">
                <img class="imgDeleteForm .image-item2  " src="{{$image->imagePath}}" alt="img"/>
                <div class="formButtons">
                <form class="" method="POST" action="{{route('slideredit.destroy', $image->id)}}">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="imgDeleteBtn">Usuń zdjęcie</button>
                </form>
                <form class="" method="POST" action="{{route('slideredit.update', $image->id)}}">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <button class="imgDeleteBtn">Dodaj do slidera</button>
                </form>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
