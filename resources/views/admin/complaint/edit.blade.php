@extends('admin.index')
@section('css')
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    {{-- @isset($title)
                    {{ $title }}
                    @else
                    Chưa có tiêu đề cho trang này
                    @endisset --}}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('complaint.editComplaint', ['id' => $complaint->id]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Complaint Name</label>
                                <input class="form-control" name="complaintName" rows="3"
                                    value="{{ empty(old('complaintName', $complaint->complaintName)) ? '' : old('complaintName', $complaint->complaintName) }}"
                                    placeholder="Enter ...">
                                @error('complaintName')
                                <div class="alert alert-danger">{{ $errors->first('complaintName') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Head image</label>
                                    <label class="btn btn-primary btn-md btn-file">
                                        Tải ảnh<input name="headImg[]" type="file" accept=".jpg, .png"
                                            onchange="previewImage('headImg')">
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="headImg_preview"></div>
                            </div>
                        </div> -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- select -->
                            <div class="form-group">
                                <label>Head image</label>
                                <div class="custom-file">
                                    <input onchange="readURL3(this)" multiple="" name="headImg[]" type="file"
                                        class="custom-file-input" id="inputFileImageItem" accept="image/*">
                                    <label class="custom-file-label" for="inputFileImageItem">Chọn ảnh</label>
                                </div>
                                @error('headImg')
                                <div class="alert alert-danger">{{ $errors->first('headImg') }}</div>
                                @enderror
                                <div id="image-preview-container" class="d-flex flex-row mb-3 mt-3">
                                    @if ($complaint->headImg)
                                    @php
                                    $images = explode(',', $complaint->headImg);
                                    @endphp
                                    @foreach ($images as $image)

                                    <img style="max-width: 100px; max-height: 100px; margin-right: 10px;"
                                        src="{{ asset('storage/images/' . trim($image)) }}">
                                    @endforeach
                                    @else
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 mt-3">
                                {{-- @if(count($getAllByIDProductItem))
                                @foreach ($getAllByIDProductItem as $key => $item)
                                <div class="d-flex flex-column justify-content-center text-center">
                                    <img style="width: 200px;height: 200px; object-fit: cover; margin-bottom: 5px;"
                                        class="rounded mr-3"
                                        src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $item->link_image ?? null)}}">
                                    <a class="text-danger"
                                        href="{{ route('product.deleteImage', ['id' => $item->id]) }}">
                                        <i class="fas fa-trash-alt">&nbsp; Xóa ảnh</i>
                                    </a>
                                </div>
                                @endforeach
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Number phone</label>
                                <input class="form-control" name="mobile" rows="3"
                                    value="{{ empty(old('mobile', $complaint->mobile)) ? '' : old('mobile', $complaint->mobile) }}"
                                    placeholder="Enter ...">
                                @error('mobile')
                                <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Money</label>
                                <input class="form-control" name="money" rows="3"
                                    value="{{ empty(old('money', $complaint->money)) ? '' : old('money', $complaint->money) }}"
                                    placeholder="Enter ...">
                                @error('money')
                                <div class="alert alert-danger">{{ $errors->first('money') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Ten san khieu nai</label>
                                <input class="form-control" name="nickname" rows="3"
                                    value="{{ empty(old('nickname', $complaint->nickname)) ? '' : old('nickname', $complaint->nickname) }}"
                                    placeholder="Enter ...">
                                @error('nickname')
                                <div class="alert alert-danger">{{ $errors->first('nickname') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Ten that san khieu nai</label>
                                <input class="form-control" name="realname" rows="3"
                                    value="{{ empty(old('realname', $complaint->realname)) ? '' : old('realname', $complaint->realname) }}"
                                    placeholder="Enter ...">
                                @error('realname')
                                <div class="alert alert-danger">{{ $errors->first('realname') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Zalo</label>
                                <input class="form-control" name="zalo" rows="3"
                                    value="{{ empty(old('zalo', $complaint->zalo)) ? '' : old('zalo', $complaint->zalo) }}"
                                    placeholder="Enter ...">
                                @error('zalo')
                                <div class="alert alert-danger">{{ $errors->first('zalo') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content">Nội Dung </label>
                                <textarea name="content"
                                    id="summernote">{{ empty(old('content', $complaint->content)) ? '' : old('content', $complaint->content) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>image</label>
                                <label class="btn btn-primary btn-md btn-file">
                                    Tải ảnh<input name="img[]" type="file" accept=".jpg, .png" multiple
                                        onchange="previewImage('img', 'img_preview')">
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="img_preview"></div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- select -->
                            <div class="form-group">
                                <label>Image</label>
                                <div class="custom-file">
                                    <input onchange="readURL3(this)" multiple="" name="img[]" type="file"
                                        class="custom-file-input" id="inputFileImageItem" accept="image/*">
                                    <label class="custom-file-label" for="inputFileImageItem">Chọn ảnh</label>
                                </div>
                                @error('img')
                                <div class="alert alert-danger">{{ $errors->first('img') }}</div>
                                @enderror
                                <div id="image-preview-container" class="d-flex flex-row mb-3 mt-3">
                                    @if ($complaint->img)
                                    @php
                                    $images = explode(',', $complaint->img);
                                    @endphp
                                    @foreach ($images as $image)
                                    <img style="max-width: 100px; max-height: 100px; margin-right: 10px;"
                                        src="{{ asset('storage/images/' . trim($image)) }}">
                                    @endforeach
                                    @else
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 mt-3">
                                {{-- @if(count($getAllByIDProductItem))
                                @foreach ($getAllByIDProductItem as $key => $item)
                                <div class="d-flex flex-column justify-content-center text-center">
                                    <img style="width: 200px;height: 200px; object-fit: cover; margin-bottom: 5px;"
                                        class="rounded mr-3"
                                        src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $item->link_image ?? null)}}">
                                    <a class="text-danger"
                                        href="{{ route('product.deleteImage', ['id' => $item->id]) }}">
                                        <i class="fas fa-trash-alt">&nbsp; Xóa ảnh</i>
                                    </a>
                                </div>
                                @endforeach
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>replenishImg</label>
                                <textarea class="form-control" name="replenishImg" rows="3"
                                    placeholder="Enter ...">{{ empty(old('replenishImg', $complaint->replenishImg)) ? '' : old('replenishImg', $complaint->replenishImg) }}</textarea>
                                @error('replenishImg')
                                <div class="alert alert-danger">{{ $errors->first('replenishImg') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>replenishContent</label>
                                <textarea class="form-control" name="replenishContent" rows="3"
                                    placeholder="Enter ...">{{ empty(old('replenishContent', $complaint->replenishContent)) ? '' : old('replenishContent', $complaint->replenishContent) }}</textarea>
                                @error('replenishContent')
                                <div class="alert alert-danger">{{ $errors->first('replenishContent') }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#summernote').summernote();
    });

    function getBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    }
</script>

<script>
    $(".browseImageMain").on("click", function () {
        var file = $(this).parents().find(".imageMain");
        file.trigger("click");
        console.log(123);
    });
    $('input[name="imageMain"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#fileImageMain").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("previewImageMain").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>
<script>
    $(document).on("click", ".browseImageSlide", function () {
        var file = $(this).parents().find(".imageSlide");
        file.trigger("click");
    });
    $('input[name="imageSlide"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#fileImageSlide").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("previewImageSlide").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>
<script>
    $(document).on("click", ".browseImageItem0", function () {
        var file = $(this).parents().find(".imageItem0");
        file.trigger("click");
    });
    $('input[name="imageItem0"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#fileImageItem0").val(fileName);

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("previewImageItem0").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields_limit = 100; //set limit for maximum input fields

        var html = '';
        $('.add_more_button').click(function (e) {
            var index = $('.imageItemcount').length + 1; //initialize counter for text box
            var indexX = index + 1;
            e.preventDefault();
            html =
                '<div class="row imageItemcount">' +
                '<div class="col-sm-3">' +
                '<div class="form-group">' +
                '<label>Ảnh Thành Phần ' + indexX + '</label>' +
                '<div id="image-form">' +
                '<input type="file" name="headImg' + index + '" class="headImg' + index +
                '" accept="image/*">' +
                '<div class="input-group my-3">' +
                '<input type="text" class="form-control" disabled placeholder="Upload File" id="fileImageItem' +
                index + '">' +
                '<div class="input-group-append">' +
                '<button type="button" class="browseImageItem' + index +
                ' btn btn-primary">Tải lên</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-9">' +
                '<img src="https://placehold.it/80x80" id="previewImageItem' + index +
                '" class="img-thumbnail">' +
                '</div>' +
                '</div>';

            $('.imageAllItem').append(html);

            $(document).on("click", ".browseImageItem" + index, function () {
                var file = $(this).parents().find(".headImg" + index);
                file.trigger("click");
            });
            $('input[name="headImg' + index + '"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $("#fileImageItem" + index).val(fileName);

                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("previewImageItem" + index).src = e.target
                        .result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
        });

        //image

        $('.add_more_button').click(function (e) {
            var index = $('.imageItemcount').length + 1; //initialize counter for text box
            var indexX = index + 1;
            e.preventDefault();
            html =
                '<div class="row imageItemcount">' +
                '<div class="col-sm-3">' +
                '<div class="form-group">' +
                '<label>Ảnh Thành Phần ' + indexX + '</label>' +
                '<div id="image-form">' +
                '<input type="file" name="img' + index + '" class="img' + index +
                '" accept="image/*">' +
                '<div class="input-group my-3">' +
                '<input type="text" class="form-control" disabled placeholder="Upload File" id="fileImageItem' +
                index + '">' +
                '<div class="input-group-append">' +
                '<button type="button" class="browseImageItem' + index +
                ' btn btn-primary">Tải lên</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-9">' +
                '<img src="https://placehold.it/80x80" id="previewImageItem' + index +
                '" class="img-thumbnail">' +
                '</div>' +
                '</div>';

            $('.imageAllItem').append(html);

            $(document).on("click", ".browseImageItem" + index, function () {
                var file = $(this).parents().find(".img" + index);
                file.trigger("click");
            });
            $('input[name="img' + index + '"]').change(function (e) {
                var fileName = e.target.files[0].name;
                $("#fileImageItem" + index).val(fileName);

                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("previewImageItem" + index).src = e.target
                        .result;
                };
                // read the image file as a data URL.
                reader.readAsDataURL(this.files[0]);
            });
        });
    });
</script>
@endsection
@section('scripts')
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(function () {
        bsCustomFileInput.init();
    });
    $(function () {
        // Summernote
        $('#summernoteDescription').summernote()
    })

    let noimage =
        "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

    function readURL(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img-preview").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $("#img-preview").attr("src", noimage);
        }
    }

    function readURL2(input) {
        console.log(input.files);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#img-preview2").attr("src", e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $("#img-preview2").attr("src", noimage);
        }
    }

    function readURL3(input) {
        $("#image-preview-container").empty();

        if (input.files && input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgPreview = $('<img style="width: 200px;height: 200px; object-fit: cover;" class="rounded mr-3"  />');
                    imgPreview.attr("src", e.target.result);
                    $("#image-preview-container").append(imgPreview);
                };

                reader.readAsDataURL(input.files[i]);
            }
        } else {
            let imgPreview = $('<img style="width: 200px;height: 200px; object-fit: cover;" class="rounded mr-3"  />');
            imgPreview.attr("src", noimage);
            $("#image-preview-container").append(imgPreview);
        }
    }
</script>
@endsection