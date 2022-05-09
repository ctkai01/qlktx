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
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" style="justify-content: center">
                    <!-- Form controls -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Tạo thông tin phòng mới</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name_room" class="form-label">Tên phòng <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="name_room" name="name_room"
                                        value="{{ old('name_room') }}" />
                                    @if ($errors->has('name_room'))
                                        <span class="error_name_room"
                                            style="color: red">{{ $errors->first('name_room') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="type_room" class="form-label">Loại phòng<span style="color: red">
                                            *</span></label>
                                    <select id="type_room" class="form-select" name="type_room">
                                        <option value="">Chọn phòng </option>
                                        <option data-img_src="{{ asset('/vip-card.png') }}" value="1">Vip</option>
                                        <option value="0">Thường</option>
                                    </select>
                                    @if ($errors->has('type_room'))
                                        <span class="error_type_room"
                                            style="color: red">{{ $errors->first('type_room') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá phòng <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}" />
                                    @if ($errors->has('price'))
                                        <span class="error_price"
                                            style="color: red">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="number_people" class="form-label">Số người ở <span style="color: red">
                                            *</span></label>
                                    <input type="number" class="form-control" id="number_people" name="number_people"
                                        value="{{ old('number_people') }}" />
                                    @if ($errors->has('number_people'))
                                        <span class="error_number_people"
                                            style="color: red">{{ $errors->first('number_people') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="avatars" class="form-label">Ảnh phòng <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" accept="image/*" type="file" multiple id="avatars"
                                        name="avatars[]" />
                                        @if ($errors->any())
                                            @php
                                            $newErrorImg = array_filter($errors->all(), function($val) {
                                                return str_starts_with($val, 'Ảnh');
                                            });
                                            foreach ($newErrorImg as $err) {
                                                echo "<span class=\"error-avatars\"
                                            style=\"color: red\">$err</span>";
                                            }
                                            @endphp
                                        @endif
                                    @if ($errors->has('avatars'))
                                        <span class="error-avatars"
                                            style="color: red">{{ $errors->first('avatars') }}</span>
                                    @endif
                                    @if ($errors->has('avatars.'))
                                        <span class="error-avatars"
                                            style="color: red">{{ $errors->first('avatars.') }}</span>
                                    @endif
                                    <div class="mt-3 mb-3 preview-img preview-image" style="display: flex; flex-wrap: wrap">
                                        <img class="ImgPreview"
                                            src="https://raw.githubusercontent.com/ctkai01/shop_game_admin/master/public/images/no-image.png"
                                            style="width:30.33333%; margin: 1.5%;" />
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center; padding-bottom: 20px">
                                <button  type="submit" style="width: 300px" class="btn btn-primary">Tạo phòng</button>
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
                    <span class="error-avatars"
                        style="color: red">{{ $errors->first('avatars.${index}') }}</span>
                @endif
                `)
                });
            })
        </script>
    @endpush
