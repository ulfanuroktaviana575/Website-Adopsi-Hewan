@extends('admin/master')

@section('title')
List Postingan Hewan
@endsection

{{-- my css --}}
@section('custom-style')

<!--STYLESHEET-->
<!--=================================================-->

<!--Open Sans Font [ OPTIONAL ]-->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


<!--Bootstrap Stylesheet [ REQUIRED ]-->
<link href="{{asset('admin/asset/css/bootstrap.min.css')}}" rel="stylesheet">


<!--Nifty Stylesheet [ REQUIRED ]-->
<link href="{{asset('admin/asset/css/nifty.min.css')}}" rel="stylesheet">


<!--Nifty Premium Icon [ DEMONSTRATION ]-->
<link href="{{asset('admin/asset/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">


<!--=================================================-->



<!--Pace - Page Load Progress Par [OPTIONAL]-->
<link href="{{asset('admin/asset/plugins/pace/pace.min.css')}}" rel="stylesheet">
<script src="{{asset('admin/asset/plugins/pace/pace.min.js')}}"></script>


<!--Demo [ DEMONSTRATION ]-->
<link href="{{asset('admin/asset/css/demo/nifty-demo.min.css')}}" rel="stylesheet">



<!--DataTables [ OPTIONAL ]-->
<link href="{{asset('admin/asset/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('admin/asset/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css')}}"
    rel="stylesheet">

<!--Animate.css [ OPTIONAL ]-->
<link href="{{asset('admin/asset/plugins/animate-css/animate.min.css')}}" rel="stylesheet">

@endsection

{{-- judul halaman pada bagian atas halaman --}}
@section('page-head')
<div id="page-head">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Data Postingan Hewan</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="#"><i class="demo-pli-home"></i></a></li>
        <li><a href="#">Posting</a></li>
        <li class="active">Data Postingan Hewan</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
</div>
@endsection

{{-- content halaman --}}
@section('content')
<div id="page-content">
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">Report Posting Hewan</h3>
        </div>
        <div class="panel-body">
            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Judul Postingan</th>
                        <th>Waktu Posting</th>
                        <th class="min-tablet">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</td>
                        <td>
                            <button class="btn btn_block btn-danger btn-rounded" data-id="{{$item->id}}"><i
                                    class="demo-pli-plus"></i>Hapus</button>

                            <a href="{{route('posting_hewan_detail',$item->id)}}" class="btn btn-warning btn-rounded">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--===================================================-->
    <!-- End Striped Table -->

</div>
@endsection

{{-- cutom java script --}}
@section('custom-js')

<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="{{asset('admin/asset/js/jquery.min.js')}}"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{asset('admin/asset/js/bootstrap.min.js')}}"></script>


<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{asset('admin/asset/js/nifty.min.js')}}"></script>




<!--=================================================-->

<!--Demo script [ DEMONSTRATION ]-->
<script src="{{asset('admin/asset/js/demo/nifty-demo.min.js')}}"></script>


<!--DataTables [ OPTIONAL ]-->
<script src="{{asset('admin/asset/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/asset/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin/asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}">
</script>


<!--DataTables Sample [ SAMPLE ]-->
<script src="{{asset('admin/asset/js/demo/tables-datatables.js')}}"></script>

<!--Bootbox Modals [ OPTIONAL ]-->
<script src="{{asset('admin/asset/plugins/bootbox/bootbox.min.js')}}"></script>

<!--Modals [ SAMPLE ]-->
{{-- <script src="{{asset('admin/asset/js/demo/ui-modals.js')}}"></script> --}}

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(Session::get('icon'))
<script>
    Swal.fire({
    icon: "{{Session::get('icon')}}",
    title: "{{Session::get('title')}}",
    text: "{{Session::get('text')}}",
});
</script>
@endif

<script>
    const URL = {
        delete : "{{route('admin.delete.report.posting','astaga')}}",
        block : "{{route('admin.block.report.posting','astaga')}}"
    }

$(".btn_delete").click(function() {
    let id = $(this).data('id')
    Swal.fire({
        icon: "question",
        title: 'Yakin menghapus report?',
        showCancelButton: true,
        confirmButtonText: `Ya, Hapus!`,
        cancelButtonText: `Batal`,
    }).then((result) => {
        if (result.isConfirmed) {
            tmpUrl = URL.delete
            window.location.replace(tmpUrl.replace('astaga', id));
        }
    })

})

$(".btn_block").click(async function(){
        let id = $(this).data('id')
        const { value: cause } = await Swal.fire({
            title: 'Masukkan Alasan Blokir',
            input: 'textarea',
            inputLabel: 'Alasan Blokir',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Harus Diisi!'
                }
            }
        })

        if (cause) {
            tmpUrl = URL.block
            tmpUrl = tmpUrl.replace('astaga',id)
            $("#main_loading").css("display", "flex");
            fetch(tmpUrl, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": document.head.querySelector("[name~=csrf-token][content]").content
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: JSON.stringify({message:cause}) // body data type must match "Content-Type" header
            })
            .then(response => {
                    return response.json()
            })
            .then(data => {
                location.reload();
            })
            .catch(err => console.log(err))
        }
        // Swal.fire({
        //     icon:"question",
        //     title: 'Yakin memblokir posting?',
        //     showCancelButton: true,
        //     confirmButtonText: `Ya, Blokir!`,
        //     cancelButtonText: `Batal`,
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         tmpUrl = URL.block
        //         tmpUrl = tmpUrl.replace('astaga',id)
        //     }
        // })
    })
</script>

@endsection
