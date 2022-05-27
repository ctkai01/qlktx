@extends('layouts.app')
@section('title_for_layout', 'Xem phòng')
@section('css')
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css"
        integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
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

        #datatableListStudentRoom_wrapper .row {
            margin-top: 30px
        }

    </style>

@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                @if (!$notRoom)
                <div class="">
                    <h3 class="mt-4" style="margin-left: 20px">Thông tin phòng</h3>
                    <div class="info-room">
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3">
                                <div class="card-body">
                                    <div class="mb-2">
                                        <strong>Mã phòng: </strong> {{ isset($room) ? $room->MaPhong : '' }}
                                    </div>
                                    <div class="mb-2">
                                        <strong>Số người quy định: </strong> {{ isset($room) ? $room->SoNguoi : '' }}
                                    </div>
                                    <div class="mb-2"
                                        style="display: flex; align-items: center; justify-content: center">
                                        <strong>Tình trạng: </strong>
                                        @if (isset($room) ? $room->TinhTrang : '')
                                            <div
                                                style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: rgb(57, 225, 111)">
                                            </div>
                                            <div class="state" style="line-height: 15px;">Còn chỗ</div>
                                        @else
                                            <div
                                                style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: red">
                                            </div>
                                            <div class="state" style="line-height: 15px;">Hết chỗ</div>
                                        @endif
                                    </div>
                                    <div class="mb-2"
                                        style="display: flex; align-items: center; justify-content: center">
                                        <strong>Loại Phòng: </strong>
                                        @if (isset($room) ? $room->LoaiPhong : '')
                                            <img width="30px" src="{{ asset('/vip-card.png') }}" />
                                        @else
                                            Thường
                                        @endif
                                    </div>
                                    <div class="mb-2">
                                        <strong>Giá phòng: </strong> <span
                                            class="price-room">{{ isset($room) ? $room->GiaPhong : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="">
                    <h3 class="mt-4" style="margin-left: 20px">Hình ảnh</h3>
                    <div class="wrapper">
                        <div class="carousel">
                            @if (isset($room))
                                @foreach ($room->media as $image)
                                    <div><img width="300" height="300" src="{{ $image->Ten }}"></div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between">
                        <h3 class="mt-4" style="margin-left: 20px">Danh sách sinh viên ở</h3>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table" id="datatableListStudentRoom">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Số thứ tự</th>
                                    <th style="text-align: center">Mã sinh viên</th>
                                    <th style="text-align: center">Ảnh</th>
                                    <th style="text-align: center">Họ tên</th>
                                    <th style="text-align: center">Ngày sinh</th>
                                    <th style="text-align: center">Lớp</th>
                                    <th style="text-align: center">Khoa</th>
                                    <th style="text-align: center">Hành động</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @else
                <div style="padding: 30px 20px; text-align: center">Bạn chưa có phòng vui lòng nhấn vào đây 
                    <a href="{{ route('student.contract') }}"><button class="btn btn-success">Gia hạn hợp đồng</button></a>
                    để gia hạn hợp đồng hoặc liên hệ trực tiếp với nhân viên trực</div>
                @endif
            </div>
            <!-- Basic Bootstrap Table -->
            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->
    </div>
@endsection
@push('after-scripts')
    <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"
        integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/dt.js') }}"></script>
    <script>
        const price = document.querySelector('.price-room')
        price.textContent = currency(Number(price.textContent), {
            precision: 0,
            separator: '.',
            symbol: ''
        }).format() + " VNĐ";



        $(document).ready(function() {
            var table = $('#datatableListStudentRoom').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: true,
                order: [
                    [0, 'desc']
                ],
                ajax: {
                    url: '{{ route('rooms.current.dt', $room->MaPhong) }}',
                    data: function(d) {
                        // d.search = $('#filter-name').val()
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'MaSV',
                        name: 'MaSV',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Anh',
                        name: 'Anh',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'HoTen',
                        name: 'HoTen',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'NgaySinh',
                        name: 'NgaySinh',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Lop',
                        name: 'Lop',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'Khoa',
                        name: 'Khoa',
                        className: 'text-center align-middle'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center align-middle'
                    }
                ]
            })


            $('.carousel').slick({
                // slidesToShow: 1,
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                // centerMode: true,
                infinite: false,
            });
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
@endpush
