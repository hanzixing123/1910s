
	@foreach($goods as $v)
		<tr>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td><font color='red'>{{$v->goods_no}}</font></td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_num}}</td>
		
			<td><font color='blue'><h3>{{$v->is_new==1?"√":"×"}}</h3></font></td>

			<td><font color='blue'><h3>{{$v->is_dest==1?"√":"×"}}</h3></font></td>
			<td><font color='blue'><h3>{{$v->is_up==1?"√":"×"}}</h3></font></td>
			<td>@if($v->img)<img width="100"    src="{{env('TUPIAN_URL')}}{{$v->img}}">@endif</td>
				<td>@if(isset($v->imgs))
				@php $imgs=explode('|',$v->imgs);@endphp
				@foreach($imgs as $vv)
			<img width="100"    src="{{env('TUPIAN_URL')}}{{$vv}}">	
				@endforeach				
				@endif</td>
			<td>{{$v->goods_desc}}</td>
			<td><a href="{{url('/goods/destroy/'.$v->goods_id)}}"  type="button"class="btn btn-info btn-lg"><font color='red'>删除</font></a> 

				 <a href="{{url('/goods/edit/'.$v->goods_id)}}"  type="button"class="btn btn-info btn-lg">修改</a></td>
		</tr>
		@endforeach
		<tr>
		<td colspan="6"align="center">{{$goods->appends($query)->links()}}</td>	
		</tr>	
<script>
	$(document).on("click",".page-item a",function(){
		var url=$(this).attr("href");
		$.ajaxSetup({ headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("conter") }});	
		$.post(url,function(res){
			$("tbody").html(res);
		});
		return false;
		//alert("KK");
		// $.ajax({
		// 		url:"{{url('/goods')}}",
		// 		data:{url:url},
		// 		type:"get",
		// 		success:function(res){
		// 			$("tbody").html(res);
		// 		}
		// 	});
		// 	return  false;
	});

</script>