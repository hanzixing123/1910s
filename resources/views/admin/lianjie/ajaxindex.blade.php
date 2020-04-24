
		@foreach($all as $v)
		<tr>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->url}}</td>
			<td>{{$v->radio==1?'LOGO连接':'文字连接'}}</td>
			<td><img  width="200" src="{{env('TUPIAN_URL')}}{{$v->img}}"></td>		
			<td><font color='red'>{{$v->desc}}</font></td>		
			<td><font color='red'>{{$v->is_del==1?'是':'否'}}</font></td>	
			<td><font color='red'>{{$v->Contact}}</font></td>	
			<td><a href="{{url('/lianjie/destroy/'.$v->id)}}" type="button"class="btn btn-info btn-lg">
				<font color='red'>删除</font></a> 
				 <a href="{{url('/lianjie/edit/'.$v->id)}}"  type="button"class="btn btn-info btn-lg">
				 	修改</a></td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6"align="center">{{$all->appends([$mingcheng,$radio])->links()}}</td>
		</tr>
