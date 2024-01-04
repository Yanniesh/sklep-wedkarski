@extends('layouts.app')

@section('content')
    <div class="mainflexcolumn">
    <div class="card-header">Ustawienie kolejności</div>
        <form method="POST" action="{{ route('order.update',1) }}">
            {{method_field('PUT')}}
            @csrf
            <input type="hidden" name="sliderorder" id="sliderorder" value="">
            <button class="save_order_button" type="submit">Zapisz kolejność</button>
            <div class="columns">
                <div class="left-column">
                    @php
                        $temp= App\Models\photos_orders::find(1);
                        $photosids = json_decode($temp->photos_ids);

                        $sliderPhotos = [];
                        foreach ($photosids as $photoId) {
                            $photo = App\Models\SliderPhoto::find($photoId);
                            if ($photo) {
                                $sliderPhotos[] = $photo;
                            }
                        }
                    @endphp

                    @foreach($sliderPhotos as $image)
                        <img class="ImgForm" data-photo-id="{{ $image->id }}" src="{{ $image->imagePath }}" alt="img">
                    @endforeach

                </div>
                <div class="right-column" id="sortable-list">
                </div>
            </div>
        </form>
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
                        return item.dataset.photoId;
                    });
                    console.log('Aktualna kolejność:', sortedItems);
                    document.getElementById('sliderorder').value = JSON.stringify(sortedItems);
                },
                onAdd: function () {
                    var rightColumn = document.getElementById('sortable-list');
                    var sortedItems = Array.from(rightColumn.children).map(function (item) {
                        return item.dataset.photoId;
                    });
                    console.log('Aktualna kolejność:', sortedItems);
                    document.getElementById('sliderorder').value = JSON.stringify(sortedItems);
                },
            });

        });

    </script>
@endsection
