<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
         Menu
        </li>
			@foreach($theloai as $tl)
				<?php
					$lt = DB::table('loaitin')->where('idTheLoai', $tl->id)->get(); 
					$sltt = 0;
					foreach($lt as $i){
					    $sltt += DB::table('tintuc')->where('idLoaiTin', $i->id)->count();
					} 
				?>
				@if($sltt == 0)
				    @continue
				@endif
		        <li href="#" class="list-group-item menu1">
		         {{$tl->Ten}}
		        </li>
		        <ul>
		        	@foreach(DB::table('loaitin')->where('idTheLoai', $tl->id)->get() as $lt)
			        	<li class="list-group-item">
			        	 <a href="{{route('LoaiTin', ['id' => $lt->id, 'TenKhongDau' => $lt->TenKhongDau])}}">{{$lt->Ten}}</a>
			        	</li>
		        	@endforeach
		        </ul>
	        @endforeach
    </ul>
</div>
