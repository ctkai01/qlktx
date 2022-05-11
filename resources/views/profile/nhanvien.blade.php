@extends('layouts.app')
@section('title_for_layout', 'Đăng ký tài khoản cho sinh viên')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4> --}}
            <form action="{{ route('profile_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row" style="justify-content: center;">
                    <!-- Form controls -->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <h5 class="card-header">Thông tin nhân viên</h5>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="masv" class="form-label">Mã nhân viên <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="masv" readonly name="masv"
                                        value="{{ $owner ? $owner->MaNV :old('masv') }}"/>
                                    @if ($errors->has('masv'))
                                        <span class="error_masv"
                                            style="color: red">{{ $errors->first('masv') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Họ và tên <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $owner ? $owner->HoTen :old('name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="error_name"
                                            style="color: red">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="dateofbirth" class="form-label">Ngày sinh <span style="color: red">
                                            *</span></label>
                                    <input class="form-control" type="date" value="{{ $owner ? date("Y-m-d", strtotime($owner->NgaySinh)) : old('dateofbirth') }}"
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
                                            <input class="form-check-input" type="radio" name="gender" value="1"  {{ $owner->GioiTinh ? 'checked' : ''; }}/>
                                            <label class="form-check-label"  for="inlineRadio2">Nam</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" {{ $owner->GioiTinh ? '' : 'checked'; }} type="radio" name="gender" value="0" />
                                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3">
                                    <label for="quequan" class="form-label">Quê quán <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="quequan" name="hometown"
                                        value="{{ $owner ? $owner->QueQuan : old('hometown') }}" />
                                    @if ($errors->has('hometown'))
                                        <span class="error_hometown"
                                            style="color: red">{{ $errors->first('hometown') }}</span>
                                    @endif
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Điện thoại <span style="color: red">
                                            *</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $owner ? $owner->DienThoai : old('phone') }}" />
                                    @if ($errors->has('phone'))
                                        <span class="error_phone"
                                            style="color: red">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="calam" class="form-label">Ca làm <span style="color: red">
                                            *</span></label>
                                    <input type="text" readonly class="form-control" id="calam" name="calam"
                                        value="{{ $owner ? $owner->CaLam : '' }}" />
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
                                        src="{{ $owner->Anh ?  $owner->Anh :  "https://raw.githubusercontent.com/ctkai01/shop_game_admin/master/public/images/no-image.png" }}"
                                            width="100%" />
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-around">
                                    <a href="#"><button type="button" class="btn btn-info">Hủy bỏ</button></a>
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Input Sizing -->
                </div>
                <div class="col-md-6">
                    <div class="card pt-4 pb-4 justify-content-center">
                       
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
        </script>
    @endpush
