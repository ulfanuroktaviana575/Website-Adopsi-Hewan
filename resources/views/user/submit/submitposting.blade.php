@extends('user/master')

@section('include-css')
{{-- data picker --}}

<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

{{-- for maps --}}
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

{{-- form informasi vaksin --}}
<style>
.delete {
    background-color: #fd1200;
    border: none;
    color: white;
    padding: 5px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
}

.add_form_field {
    background-color: #1c97f3;
    border: none;
    color: white;
    padding: 8px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border: 1px solid #186dad;
}
</style>
@endsection

@section('page-title')
<div class="page-title">
    <div class="container">
        <h1 class="center">
            Submit Hewan Peliharaan Anda untuk Diadopsi
        </h1>
    </div>
    <!--end container-->
</div>
@endsection

@section('nama-hero')

@endsection

@section('brand-logo')
{{asset('user/assets/img/include_image/logo_adoptpets.png')}}
@endsection

@section('hero-form')

@endsection

@section('background')
<div class="background">
    <div class="background-image">
        <img src="{{asset('user/assets/img/include_image/bg_akunsaya.jpg')}}" alt="">
    </div>
    <!--end background-image-->
</div>
@endsection

@section('include-css')
<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
<script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
@endsection

@section('content')
<section class="block">
    <div class="container">
        <form class="form" action="{{route('post_posting')}}" method="POST" id="submitposting"
            enctype="multipart/form-data">
            @csrf

            {{-- section detail informasi hewan --}}
            <section>
                <h2>Deskripsi</h2>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title" class="col-form-label required">Judul</label>
                            <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                id=" title" placeholder="contoh : Kucing Persia" required value="{{old('title')}}">
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ras" class="col-form-label required">Jenis Hewan</label>
                            <select class="change-tab" data-change-tab-target="category-tabs" name="submit_category"
                                id="submit-category" data-placeholder="Select Category">
                                <option value="">Pilih Jenis Hewan</option>
                                @foreach ($data as $item)
                                <option @if ($item->id == old("submit_category"))
                                    {{ "selected" }}
                                    @endif value="{{$item->id}}">{{$item->nama}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!--end form-group-->
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ras" class="col-form-label required">Ras</label>
                            <input name="ras" type="text" class="form-control @error('ras') is-invalid @enderror"
                                id=" ras" placeholder="contoh : persia" required value="{{old('ras')}}">
                        </div>
                        @error('ras')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="umur" class="col-form-label required">Umur</label>
                            <input name="umur" type="number" class="form-control @error('umur') is-invalid @enderror"
                                id=" umur" placeholder="Masukkan usia dalam bentuk jumlah bulan. contoh : 1"
                                value="{{old('umur')}}">
                        </div>
                        @error('umur')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ras" class="col-form-label required">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" data-placeholder="Select">
                                <option {{old('jenis_kelamin') == null ? "selected" : ""}} value="0">Pilih Jenis Kelamin
                                </option>
                                <option value="Betina" {{old('jenis_kelamin') == "Betina" ? "selected" : ""}}>Betina
                                </option>
                                <option value="Jantan" {{old('jenis_kelamin') == "Jantan" ? "selected" : ""}}>Jantan
                                </option>
                            </select>
                            <!-- <div style="display: none;" class="alert alert-danger" id="message_jk">Silahkan pilih opsi
                            </div> -->
                        </div>
                        <!--end form-group-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="warna" class="col-form-label required">Warna</label>
                            <input name="warna" type="text" class="form-control @error('warna') is-invalid @enderror"
                                id="warna" placeholder="contoh : abu mix putih" required
                                value="{{old('warna')}}"></input>
                        </div>
                        @error('warna')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end col-md-8-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="makanan" class="col-form-label required">Makanan</label>
                            <input name="makanan" type="text"
                                class="form-control @error('makanan') is-invalid @enderror" id="
                        makanan" placeholder="contoh : Makanan Kering/Basah" required value="{{old('makanan')}}">
                        </div>
                        @error('makanan')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!--end form-group-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row-md-2">
                            <div class="form-group">
                                <label for="kondisi_fisik" class="col-form-label required">Kondisi Fisik</label>
                                <textarea name="kondisi_fisik" id="kondisi_fisik"
                                    class="form-control @error('kondisi_fisik') is-invalid @enderror" rows=" 6"
                                    placeholder="contoh : ada luka dibagian telinga"
                                    required>{{old('kondisi_fisik')}}</textarea>
                            </div>
                            @error('kondisi_fisik')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!--end form-group-->
                        </div>
                        <div class="row-md-2">
                            <div class="form-group">
                                <label for="informasi_lain" class="col-form-label">informasi lain</label>
                                <textarea name="informasi_lain" id="informasi_lain"
                                    class="form-control @error('informasi_lain') is-invalid @enderror" rows="6"
                                    placeholder="contoh : kebiasaan kucing suka makan daun">{{old('informasi_lain')}}</textarea>
                            </div>

                            <!--end form-group-->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group container1">
                            {{-- button tambah vaksin --}}
                            <label for="informasi_vaksin" class="col-form-label">Informasi Vaksin</label><br>
                            <button type="button"
                                class="btn add_info_button add_form_field btn-info small icon float-left">Tambah
                                Vaksin</i></button>
                            {{-- akhir button tambah vaksin --}}
                        </div>
                    </div>
                    <!--end col-md-8-->
                </div>
            </section>


            {{-- section foto hewan hewan --}}
            <section>
                <h2>Foto Hewan</h2>
                <label for="kondisi_fisik" class="col-form-label required">Upload Foto Hewan</label>
                <div class="file-upload-previews"></div>
                <div class="file-upload">
                    <input type="file" name="path[]"
                        class="file-upload-input with-preview @error('path') is-invalid @enderror" multiple
                        title="Click to add path" maxlength="10" accept="gif|jpg|png|mp4|webm|mpg">
                    <span><i class="fa fa-plus-circle"></i>Click or drag images here</span>
                    <small class="form-text text-muted">- Ukuran max 6MB</small>
                    <br>
                </div>
                @error('path')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </section>


            {{-- section lokasi --}}
            <section>
                <h2>Lokasi</h2>
                <!--end row-->
                <div class="form-group">
                    <label for="input-location" class="col-form-label required">Detail Lokasi</label>
                    <input name="city" type="text" class="form-control" id="city" placeholder="Location"
                        readonly="readonly" value="Jakarta" name="city">
                    <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top"
                        title="Find My Position"><i class="fa fa-map-marker"></i></span>
                </div>
                <small class="form-text text-muted">Geser Tanda Hijau Untuk Memindah</small>

                <!--end form-group-->
                <label>Map</label>
                <div id="map" style="width: 100%; height: 480px"></div>
                {{-- <div class="map height-400px" id="map-submit"></div> --}}
                <input name="latitude" type="text" class="form-control" id="latitude" value="-6.200000" hidden>
                <input name="longitude" type="text" class="form-control" id="longitude" value="106.816666" hidden>
                <small class="form-text text-muted">Geser Tanda Hijau Untuk Memindah</small>
            </section>
            <!--end location-->


            <section class="clearfix">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary large icon float-right">Submit</i></button>
                </div>
            </section>
        </form>
        <!--end form-submit-->
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection

@section('js_mid')
<script src="{{asset('user/assets/js/jQuery.MultiFile.min.js')}}"></script>
@endsection

@section('js_after')
<script src="{{asset('user/assets/js/page/submitpostingan.js')}}"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
{{-- js datepicker --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
    integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
    crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// add form dynamic
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        // console.log("1");

        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append(
                '<div><input name="informasi_vaksin[]" type="text" class="form-control @error('
                informasi_vaksin ') is-invalid @enderror" id=" informasi_vaksin" placeholder="" value=""> <small class="form-text">Masukkan Nama Vaksin</small> @error('
                informasi_vaksin ') <div class="alert alert-danger">{{ $message }}</div> @enderror <input name="tanggal[]"  type="text" class="datepicker form-control date_input @error('
                tanggal ') is-invalid @enderror" id="tanggal" placeholder="" value=""/><small class="form-text">Masukkan Tanggal Vaksin</small> <br> @error('
                tanggal ') <div class="alert alert-danger">{{ $message }}</div> @enderror <a href="#" class=" btn small btn-danger delete">Delete</a></div>'
            ); //add input box

        } else {
            alert('You Reached the limits')
        }
    });

    $(document).on('focus', ".datepicker", function() {
        $(this).datepicker({
            uiLibrary: 'bootstrap4'
        });
    });

    $(wrapper).on("click", ".delete", function(e) {
        // console.log("2");
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
    $("#submitposting").on("submit", function() {
        let dateEl = $('.date_input')
        for (let i = 0; i < dateEl.length; i++) {
            console.log(moment(dateEl[i].value, "MM/DD/YYYY", true).isValid());
            if (!moment(dateEl[i].value, "MM/DD/YYYY", true).isValid()) {
                swal({
                    icon: "error",
                    title: "Maaf!",
                    text: "Tanggal Vaksin Salah!",
                });
                event.preventDefault();
                return;
            }
        }
    })
});
</script>

{{-- selecter jenis_kelamin --}}
<script>
$("#submitposting").on("submit", function() {
    if ($("#jenis_kelamin").val() == 0) {
        event.preventDefault();
        $("#message_jk").show();
    }
})
</script>

@error('path')
<script>
swal({
    icon: "error",
    title: "Maaf!",
    text: "Foto tidak boleh kosong!",
});
// swal("PESAN", "sub pesan", "error");
</script>
@enderror

@endsection