@extends('layouts.app')
@section('title_for_layout', 'Đăng ký tài khoản cho sinh viên')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4> --}}
            <form action="{{ route('student.contract_post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" style="justify-content: center">
                    <!-- Input Sizing -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Gia hạn hợp đồng</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">Phòng<span style="color: red">
                                            *</span></label>
                                    <select id="rooms" class="form-select" name="rooms">
                                        <option value="">Chọn phòng</option>

                                        @foreach ($rooms as $room)
                                            <option value={{ $room->MaPhong }}
                                                {{ $roomStudent->MaPhong == $room->MaPhong ? 'selected' : '' }}>
                                                {{ $room->MaPhong }}</option>
                                            {{-- <option value={{ $room->MaPhong }}>{{ $room->MaPhong }}</option> --}}
                                        @endforeach
                                    </select>
                                    <div class="info-room mt-2" style="display: flex; justify-content: space-around">
                                    </div>
                                    @if ($errors->has('rooms'))
                                        <span class="error_rooms"
                                            style="color: red">{{ $errors->first('rooms') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="date_register" class="form-label">Hạn hợp đồng <span style="color: red">
                                            *</span></label>
                                    <input readonly class="form-control" type="date" value="{{ $contract->NgayHetHan }}"
                                        name="date_register" id="date_register" />
                                    @if ($errors->has('date_register'))
                                        <span class="error_date_register"
                                            style="color: red">{{ $errors->first('date_register') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="aboutThue" class="form-label">Thời gian thuê <span style="color: red">
                                            *</span></label>
                                    <select id="aboutThue" class="form-select" name="aboutThue">
                                        <option value="1">1 Tháng</option>
                                        <option value="3">3 Tháng</option>
                                        <option value="6">6 Tháng</option>
                                    </select>
                                    <input type="hidden" class="exprired_date" name="exprired_date" />
                                    <div style="text-align: end" class="mt-2 until-date"></div>
                                    {{-- @if ($errors->has('aboutThue'))
                                        <span class="error_aboutThue"
                                            style="color: red">{{ $errors->first('aboutThue') }}</span>
                                    @endif --}}
                                </div>
                                <div class="mb-3">
                                    <label for="chuthich" class="form-label">Chú thích</label>
                                    <textarea class="form-control" name="chuthich" id="chuthich">{{ old('chuthich') }}</textarea>
                                    @if ($errors->has('chuthich'))
                                        <span class="error_chuthich"
                                            style="color: red">{{ $errors->first('chuthich') }}</span>
                                    @endif
                                </div>
                                <div style="display: flex; justify-content: space-around">
                                    <button type="button" class="btn btn-info">Hủy bỏ</button>
                                    <button type="submit" class="btn btn-success">Gia hạn</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- <div class="col-md-12">
                    <div class="card pt-4 pb-4 justify-content-center">
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                    </div>
                </div> --}}
            </form>


            <!-- / Content -->
        </div>
    @endsection
    @push('after-scripts')
        <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script>
            // $('input[name="date_register"]').bind('change', function() {
            //     const currentDate = moment($('input[name="date_register"]').val());
            //     const monthsAdd = Number($('select[name="aboutThue"]').val())
            //     const futureDate = currentDate.add(monthsAdd, 'months').format('YYYY-MM-DD')
            //     const futureDateFormat = moment($('input[name="date_register"]').val()).add(monthsAdd, 'months').format(
            //         'DD-MM-YYYY')
            //     document.querySelector('.until-date').textContent = `Thời hạn đến ${futureDateFormat}`
            //     $('.exprired_date').val(futureDate)
            // })


            // $('input[name="date_register"]').val(moment().format('YYYY-MM-DD'))

            $('select[name="aboutThue"]').bind('change', function() {
                const currentDate = moment($('input[name="date_register"]').val());
                const monthsAdd = Number($('select[name="aboutThue"]').val())
                const futureDate = currentDate.add(monthsAdd, 'months').format('YYYY-MM-DD')
                const futureDateFormat = moment($('input[name="date_register"]').val()).add(monthsAdd, 'months').format(
                    'DD-MM-YYYY')
                document.querySelector('.until-date').textContent = `Thời hạn đến ${futureDateFormat}`
                $('.exprired_date').val(futureDate)
            })
            const currentDate = moment($('input[name="date_register"]').val());
            const monthsAdd = Number($('select[name="aboutThue"]').val())
            const futureDate = currentDate.add(monthsAdd, 'months').format('YYYY-MM-DD')
            const futureDateFormat = moment($('input[name="date_register"]').val()).add(monthsAdd, 'months').format(
                'DD-MM-YYYY')
            document.querySelector('.until-date').textContent = `Thời hạn đến ${futureDateFormat}`
            $('.exprired_date').val(futureDate)



            const rooms = JSON.parse(JSON.stringify(<?php echo json_encode($rooms); ?>));
            const roomCurrent = JSON.parse(JSON.stringify(<?php echo json_encode($roomStudent); ?>));

            if (roomCurrent) {
                let routeRoom = `{{ asset('/phong') }}`
                routeRoom += `/${roomCurrent.MaPhong}`
                const stateRoom = roomCurrent.TinhTrang == 1 ? `
                            <div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: rgb(57, 225, 111)"></div>
                            <div class="state" style="line-height: 15px;">Còn chỗ</div>
                    ` : `<div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: red"></div>
                            <div class="state" style="line-height: 15px;">Hết chỗ</div>`

                const typeRoom = roomCurrent.LoaiPhong == 1 ? `<img width="30px" src="{{ asset('/vip-card.png') }}"/>` :
                    'Thường'
                htmlAdd = `
                    <div>
                        <div>Tình trạng:</div>
                        <div style="display: flex; align-items: center">
                            ${stateRoom}
                        </div>
                    </div>
                    <div>
                        <div>Loại phòng:</div>
                        <div style="display: flex; align-items: center; justify-content: center">
                            ${typeRoom}
                        </div>
                    </div>
                    <div>
                        <div>Giá phòng:</div>
                        <div style="display: flex; align-items: center; justify-content: center">
                            <div class="money-room">${roomCurrent.GiaPhong}</div>
                            <img width="30px" src="{{ asset('/vnd.jpeg') }}"/>
                        </div>
                    </div>
                    <div>
                        <div>Chi tiết</div>
                        <a href="${routeRoom}">Chi tiết</a>
                    </div>
                    `
                $('.info-room').html('').append(htmlAdd)
                const formatMoney = currency(Number($('.money-room').text()), {
                    precision: 0,
                    separator: '.',
                    symbol: ''
                }).format();
                $('.money-room').text(`${formatMoney} VNĐ`)
            }

            $('#rooms').on('change', function() {
                let htmlAdd = ""
                if ($('#rooms').val()) {
                    const room = rooms.find(room => room.MaPhong === $('#rooms').val());
                    console.log(room);
                    let routeRoom = `{{ asset('/phong') }}`
                    routeRoom += `/${room.MaPhong}`
                    const stateRoom = room.TinhTrang == 1 ? `
                            <div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: rgb(57, 225, 111)"></div>
                            <div class="state" style="line-height: 15px;">Còn chỗ</div>
                    ` : `<div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: red"></div>
                            <div class="state" style="line-height: 15px;">Hết chỗ</div>`

                    const typeRoom = room.LoaiPhong == 1 ? `<img width="30px" src="{{ asset('/vip-card.png') }}"/>` :
                        'Thường'
                    htmlAdd = `
                    <div>
                        <div>Tình trạng:</div>
                        <div style="display: flex; align-items: center">
                            ${stateRoom}
                        </div>
                    </div>
                    <div>
                        <div>Loại phòng:</div>
                        <div style="display: flex; align-items: center; justify-content: center">
                            ${typeRoom}
                        </div>
                    </div>
                    <div>
                        <div>Giá phòng:</div>
                        <div style="display: flex; align-items: center; justify-content: center">
                            <div class="money-room">${room.GiaPhong}</div>
                            <img width="30px" src="{{ asset('/vnd.jpeg') }}"/>
                        </div>
                    </div>
                    <div>
                        <div>Chi tiết</div>
                        <a href="${routeRoom}">Chi tiết</a>
                    </div>
                    `
                }
                $('.info-room').html('').append(htmlAdd)
                const formatMoney = currency(Number($('.money-room').text()), {
                    precision: 0,
                    separator: '.',
                    symbol: ''
                }).format();
                $('.money-room').text(`${formatMoney} VNĐ`)
            })
        </script>
    @endpush
