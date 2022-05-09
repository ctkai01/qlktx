@extends('layouts.app')
@section('title_for_layout', 'Danh sách phòng')
@section('css')
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <style>
        .info-room {
            /* color: aqua; */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .wrapper {
            width: 100%;
            padding-top: 20px;
            text-align: center;
        }

        h2 {
            font-family: sans-serif;
            color: #fff;
        }

        .carousel {
            width: 90%;
            margin: 0px auto;
        }

        .slick-slide {
            margin: 10px;
        }

        .slick-slide img {
            width: 100%;
            border: 2px solid #fff;
        }

        .wrapper .slick-dots li button:before {
            font-size: 20px;
            color: white;
        }

        .slick-prev:before {
            color: #000;
        }

        .slick-next:before {
            color: #000;
        }

        .slick-dots li.slick-active button:before,
        .slick-dots li button:before {
            color: orange !important;
        }

    </style>

@endsection
@section('content')
    <div class="content-wrapper">
        {{-- <div class="card">
           ds
       </div> --}}
        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4> --}}
            <form action="{{ route('rooms.store_bill', $room->MaPhong) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" style="justify-content: center">
                    <!-- Form controls -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Tạo hóa đơn cho phòng {{ $room->MaPhong }}</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="date_year" class="form-label">Hóa đơn cho: <span style="color: red">
                                            *</span></label>
                                    <input type="month" lang="fr-CA" class="form-control" id="date_year" name="date_year"
                                        value="{{ old('date_year') }}" />

                                    @if ($errors->has('date_year'))
                                        <span class="error_date_year"
                                            style="color: red">{{ $errors->first('date_year') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price_electric" class="form-label">Tiền điện <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="price_electric" name="price_electric"
                                        value="{{ old('price_electric') }}" />
                                    @if ($errors->has('price_electric'))
                                        <span class="error_price_electric"
                                            style="color: red">{{ $errors->first('price_electric') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price_water" class="form-label">Tiền nước <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="price_water" name="price_water"
                                        value="{{ old('price_water') }}" />
                                    @if ($errors->has('price_water'))
                                        <span class="error_price_water"
                                            style="color: red">{{ $errors->first('price_water') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price_others" class="form-label">Tiền phát sinh</label>
                                    <input type="text" class="form-control" id="price_others" name="price_others"
                                        value="{{ old('price_others') }}" />
                                    @if ($errors->has('price_others'))
                                        <span class="error_price_others"
                                            style="color: red">{{ $errors->first('price_others') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea type="text" class="form-control" id="note" name="note">{{ old('note') }}</textarea>
                                    @if ($errors->has('note'))
                                        <span class="error_note"
                                            style="color: red">{{ $errors->first('note') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center; padding-bottom: 20px">
                                <button type="submit" style="width: 300px" class="btn btn-primary">Tạo hóa đơn</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    @endsection
    @push('after-scripts')
        <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/amiryxe/easy-number-separator/easy-number-separator.js"></script>
        <script>
            // const price = document.querySelector('.price')
            // price.textContent = currency(Number(price.textContent), {
            //     precision: 0,
            //     separator: '.',
            //     symbol: ''
            // }).format();
            // easyNumberSeparator({
            //     selector: '#price',
            //     separator: '.'
            // })
            // const monthString = 'Tháng 1'

            let images = []

            $('#avatars').on('change', function(e) {
                images = []
                let lImg = $(this)[0].files
                delete lImg['length']
                for (const [key, value] of Object.entries(lImg)) {
                    // console.log(`${key}: ${value.name}`);
                    images.push(URL.createObjectURL(value))

                }
                $('.preview-image').html('')
                images.forEach((img, index) => {
                    $('.preview-image').append(`
                <img class="ImgPreview"
                src="${img}"
                style="width:30.33333%; margin: 1.5%;" />
                @if ($errors->has('avatars.${index}'))
                    <span class="error-avatars" style="color: red">{{ $errors->first('avatars.${index}') }}</span>
                @endif
                `)
                });
            })
        </script>
    @endpush
