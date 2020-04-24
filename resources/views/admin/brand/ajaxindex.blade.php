
		
	@foreach($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>@if($v->brand_logo)<img width="100"    src="{{env('TUPIAN_URL')}}{{$v->brand_logo}}">@endif</td>
			<td>{{$v->brand_desc}}</td>
			<td><a href="{{url('/brand/destroy/'.$v->brand_id)}}"   type="button"class="btn btn-info btn-lg"><font color='red'>删除</font></a> 

				 <a href="{{url('/brand/edit/'.$v->brand_id)}}"  type="button"class="btn btn-info btn-lg">修改</a></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6"align="center">{{$brand->appends(['brand_name'=>$brand_name])->links() }}</td>
		</tr>
<script>
	$(document).on('click',".page-item a",function(){
		var _this=$(this);
		var url=_this.attr("href");
		//alert(url);
		$.get(url,function(res){
			$("tbody").html(res);
		});
		return false;
	});

</script>