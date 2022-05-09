@extends('layouts.app')
@section('title_for_layout', 'Đăng ký tài khoản cho sinh viên')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4> --}}
            <form action="{{ route('register.student.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Form controls -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Thông tin đăng ký</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="masv" class="form-label">Mã sinh viên <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="masv" name="masv"
                                        value="{{ old('masv') }}" />
                                    @if ($errors->has('masv'))
                                        <span class="error_masv"
                                            style="color: red">{{ $errors->first('masv') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="error_name"
                                            style="color: red">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="dateofbirth" class="form-label">Ngày sinh <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" type="date" value="{{ old('dateofbirth') }}"
                                        name="dateofbirth" id="dateofbirth" />
                                    @if ($errors->has('dateofbirth'))
                                        <span class="error_dateofbirth"
                                            style="color: red">{{ $errors->first('dateofbirth') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Giới tính <span style="color: red">
                                            *</span></label>
                                    <div style="display: flex; justify-content: space-around">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="1" checked />
                                            <label class="form-check-label" for="inlineRadio2">Nam</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="0" />
                                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="quequan" class="form-label">Quê Quán <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="quequan" name="hometown"
                                        value="{{ old('hometown') }}" />
                                    @if ($errors->has('hometown'))
                                        <span class="error_hometown"
                                            style="color: red">{{ $errors->first('hometown') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Điện thoại <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" />
                                    @if ($errors->has('phone'))
                                        <span class="error_phone"
                                            style="color: red">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="class" class="form-label">Lớp <span style="color: red"> *</span></label>
                                    <input type="text" class="form-control" id="class" name="class"
                                        value="{{ old('class') }}" />
                                    @if ($errors->has('class'))
                                        <span class="error_class"
                                            style="color: red">{{ $errors->first('class') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="khoa" class="form-label">Khoa <span style="color: red"> *</span></label>
                                    <input type="text" class="form-control" id="khoa" name="khoa"
                                        value="{{ old('khoa') }}" />
                                    @if ($errors->has('khoa'))
                                        <span class="error_khoa"
                                            style="color: red">{{ $errors->first('khoa') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Ảnh đại diện <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" accept="image/*" type="file" id="avatar" name="avatar" />
                                    @if ($errors->has('avatar'))
                                        <span class="error-image"
                                            style="color: red">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    <div class="mt-3 mb-3 preview-img preview-image" style="width: 150px;">
                                        <img id="ImgPreview"
                                            src="https://raw.githubusercontent.com/ctkai01/shop_game_admin/master/public/images/no-image.png"
                                            width="100%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Input Sizing -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Tài Khoản đăng ký</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="account" class="form-label">Tài khoản <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" type="text" value="{{ old('account') }}" name="account"
                                        id="account" />
                                    @if ($errors->has('account'))
                                        <span class="error_account"
                                            style="color: red">{{ $errors->first('account') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" type="password" value="{{ old('password') }}"
                                        name="password" id="password" />
                                    @if ($errors->has('password'))
                                        <span class="error_password"
                                            style="color: red">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <h5 class="card-header">Hợp đồng đăng ký</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="rooms" class="form-label">Phòng<span style="color: red">
                                            *</span></label>
                                    <select id="rooms" class="form-select" name="rooms">
                                        <option value="">Chọn phòng</option>

                                        @foreach ($rooms as $room)
                                            <option value={{ $room->MaPhong }}>{{ $room->MaPhong }}</option>
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
                                    <label for="date_register" class="form-label">Ngày đăng ký <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" type="date" value="{{ old('date_register') }}"
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card pt-4 pb-4 justify-content-center">
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                    </div>
                </div>
            </form>


            <!-- / Content -->
        </div>
    @endsection
    @push('after-scripts')
        <script src="https://unpkg.com/currency.js@~2.0.0/dist/currency.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script>
            function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(imgControlName).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('input[name="avatar"]').bind('change', function() {
                var a = 1;
                var ext = $(this).val().split('.').pop().toLowerCase();
                if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg', 'svg']) == -1) {
                    $('#error-image').html(
                        'Hình ảnh không đúng định dạng! Định dạng ảnh phải là JPG, JPEG, PNG hoặc GIF.'
                    );
                    $('#error-image').slideDown("slow");
                    $('.error-image').hide();
                    $('#image').val("");
                    a = 0;
                } else {
                    var picsize = (this.files[0].size);
                    if (picsize > 1024 * 1024 * 10) {
                        $('#error-image').html('Hình ảnh không được lớn hơn 10MB.');
                        $('#error-image').show();
                        $('.error-image').hide();
                        $('#image').val("");
                        a = 0;
                    } else {
                        a = 1;
                        $('#error-image').slideUp("slow");
                        $('.error-image').hide();
                    }
                    if (a == 1) {
                        $('#error-image').slideUp("slow");
                        var imgControlName = "#ImgPreview";
                        readURL(this, imgControlName);
                        $('.preview-image').show();
                    }
                }
            });

            $('input[name="date_register"]').bind('change', function() {
                const currentDate = moment($('input[name="date_register"]').val());
                const monthsAdd = Number($('select[name="aboutThue"]').val())
                const futureDate = currentDate.add(monthsAdd, 'months').format('YYYY-MM-DD')
                const futureDateFormat = moment($('input[name="date_register"]').val()).add(monthsAdd, 'months').format(
                    'DD-MM-YYYY')
                document.querySelector('.until-date').textContent = `Thời hạn đến ${futureDateFormat}`
                $('.exprired_date').val(futureDate)
            })


            $('input[name="date_register"]').val(moment().format('YYYY-MM-DD'))

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

            //Handle Rooms
            const rooms = JSON.parse(JSON.stringify(<?php echo json_encode($rooms); ?>));
            $('#rooms').on('change', function() {
                let htmlAdd = ""
                if ($('#rooms').val()) {
                    const room = rooms.find(room => room.MaPhong === $('#rooms').val());
                    const stateRoom = room.TinhTrang == 1 ? `
                            <div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: rgb(57, 225, 111)"></div>
                            <div class="state" style="line-height: 15px;">Còn chỗ</div>
                    ` : `<div style="margin: 0 4px; width: 10px; height: 10px; border-radius: 50%; background-color: red"></div>
                            <div class="state" style="line-height: 15px;">Hết chỗ</div>`
                    
                    const typeRoom = room.LoaiPhong == 1 ? `<img width="30px" src="{{ asset('/vip-card.png') }}"/>` : 'Thường'
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
                    `
                }
                $('.info-room').html('').append(htmlAdd)
                const formatMoney = currency(Number($('.money-room').text()), { precision: 0, separator: '.', symbol: '' }).format();
                $('.money-room').text(`${formatMoney} VNĐ`)
            })
        </script>
    @endpush
