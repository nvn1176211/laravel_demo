@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

    @include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
        
        {{-- menu --}}
        @include('layout.menu')

        <div class="col-md-9 ">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                    <h4><b>{{$loaitin->Ten}}</b></h4>
                </div>
                @foreach($tintuc as $tt)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="{{route('TinTuc', ['id'=>$tt->id, 'TieuDeKhongDau'=>$tt->TieuDeKhongDau])}}">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{$tt->TieuDe}}</h3>
                            <p>{{$tt->TomTat}}</p>
                            <a class="btn btn-primary" href="{{route('TinTuc', ['id'=>$tt->id, 'TieuDeKhongDau'=>$tt->TieuDeKhongDau])}}">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                @endforeach



                <!-- Pagination -->
                <div style="text-align: center">
                    {{$tintuc->links()}}
                </div>
                <!-- /.row -->

            </div>
        </div> 
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection