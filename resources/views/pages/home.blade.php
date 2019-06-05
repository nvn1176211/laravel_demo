@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

 	@include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
    	
		{{-- menu --}}
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
                </div>
                @foreach($theloai  as $tl)
                    <?php 
                        $lt = DB::table('loaitin')->where('idTheLoai', $tl->id)->get();
                        $sltt = 0;
                        foreach($lt as $i){
                            $sltt += DB::table('tintuc')->where('idLoaiTin', $i->id)->count();
                        } 
                        $data = collect([]);
                    ?>
                    @if($sltt == 0)
                        @continue
                    @endif
                    <div class="panel-body">
                        <div class="row-item row">
                            <h3>
                                <span>{{$tl->Ten}}<span> |  
                                @foreach($lt as $i)
                                    <small><a href="{{route('LoaiTin', ['id'=>$i->id, 'TenKhongDau'=>$i->TenKhongDau])}}"><i>{{$i->Ten}}</i></a>/</small>
                                    <?php 
                                        $dt = DB::table('tintuc')->where('idLoaiTin', $i->id)->get();
                                        $data = $data->merge($dt);
                                    ?>
                                @endforeach
                                <?php 
                                    $dtt = $data->count();
                                    $data = $data->sortByDesc('id')->take(5);
                                    $fdata = $data->shift();
                                ?>
                            </h3>
                            <div class="col-md-8 border-right">
                                <div class="col-md-5">
                                   <a href="{{route('TinTuc', ['id'=>$fdata->id, 'TieuDeKhongDau'=>$fdata->TieuDeKhongDau])}}">
                                       <img class="img-responsive" src="upload/tintuc/{{$fdata->Hinh}}" alt="">
                                   </a>
                                </div>
                                <div class="col-md-7">
                                   <h3>{!! $fdata->TieuDe !!}</h3>
                                   <p>{!! $fdata->TomTat !!}</p>
                                   <a class="btn btn-primary" href="{{route('TinTuc', ['id'=>$fdata->id, 'TieuDeKhongDau'=>$fdata->TieuDeKhongDau])}}">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                @foreach($data as $d)
                                  <a href="{{route('TinTuc', ['id'=>$d->id, 'TieuDeKhongDau'=>$d->TieuDeKhongDau])}}">
                                       <h4>
                                          <span class="glyphicon glyphicon-list-alt"></span>
                                        {{$d->TieuDe}}
                                       </h4>
                                  </a>  
                                @endforeach
                            </div>
                            <div class="break"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection