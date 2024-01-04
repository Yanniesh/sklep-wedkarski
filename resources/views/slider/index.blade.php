@extends('layouts.app')

@section('content')
    <div class="contentFlex">
        <div class="div-FormCenter">
{{--            <div style="text-align:center;" class="nav-item">--}}
{{--                <a class="nav-link" style="text-align:center; margin: 0 auto"  href="{{ route('order') }}">Ustal kolejność</a>--}}
{{--            </div>--}}
            <form class="FormCenter" method="post" enctype="multipart/form-data" action="{{ route('slideredit') }}">
                @csrf
{{--                    <div class="labelXinput">--}}
{{--                        <label for="caption" class="pad-TB-5">Opis</label>--}}
{{--                        <input id="caption" type="text" class="form-control pad-TB-5" name="caption" required>--}}
{{--                    </div>--}}
                    <div class="labelXinput">
                        <label class="pad-TB-5" for="image">Wybierz zdjęcie do dodania:</label>
                        <input class="form-control pad-TB-5" type="file" id="image" name="image" accept="image/png, image/jpeg" />
                    </div>
                        <button class="margin-5 nav-item submitfoty">Submit</button>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                         @endif
                        <div>-------------------------------</div>
            </form>
        </div>
        <form method="POST" action="{{ route('order.update', 1) }}">
            {{method_field('PUT')}}
            @csrf
            <input type="hidden" name="sliderorder" id="sliderorder" value="">
            <button class="save_order_button" type="submit">Zapisz kolejność</button>
        </form>

            <div class="columns">
                <div class="left-column">
                    @foreach(App\Models\SliderPhoto::all() as $image)
                        <div class="ImgForm">
                            <img class="sortableIMG imgDeleteForm" data-photo-id="{{ $image->id }}" src="{{$image->imagePath}}" alt="img"/>
                            <div class="formButtons">
                                <form class="" method="POST" action="{{route('slideredit.destroy', $image->id)}}">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="imgDeleteBtn">Usuń zdjęcie</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="right-column" id="sortable-list">

                </div>
            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        function saveOrder() {
            var rightColumn = document.getElementById('sortable-list');
            var sortedItems = Array.from(rightColumn.children).map(function (item) {
                return item.dataset.photoId;
            });
            console.log('Aktualna kolejność:', sortedItems);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var leftColumn = document.querySelector('.left-column');
            var rightColumn = document.getElementById('sortable-list');

            new Sortable(leftColumn, {
                group: 'shared',
                animation: 150
            });

            new Sortable(rightColumn, {
                group: 'shared',
                animation: 150,
                onUpdate: function () {
                    var rightColumn = document.getElementById('sortable-list');
                    var sortedItems = Array.from(rightColumn.children).map(function (item) {
                        // return item.dataset.photoId;
                        return item.querySelector('.sortableIMG').dataset.photoId;
                    });
                    console.log('Aktualna kolejność:', sortedItems);
                    document.getElementById('sliderorder').value = JSON.stringify(sortedItems);
                },
                onAdd: function () {
                    var rightColumn = document.getElementById('sortable-list');
                    var sortedItems = Array.from(rightColumn.children).map(function (item) {
                        return item.querySelector('.sortableIMG').dataset.photoId;
                    });
                    console.log('Aktualna kolejność:', sortedItems);
                    document.getElementById('sliderorder').value = JSON.stringify(sortedItems);
                },
            });

        });

    </script>
@endsection
