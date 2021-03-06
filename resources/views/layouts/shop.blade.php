<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>微商城-@yield('title')</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    
    <!-- Bootstrap -->
     <script src="/static/index/js/jquery.min.js"></script>
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">

     @yield('content')
       @php $name=Route::currentRouteName();@endphp
     @if($name!='shop.car')
     <div class="height1"></div>
     <div class ="footNav">
      <dl>
       <a href="{{url('')}}">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="{{url('goodsList')}}">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="{{url('car')}}">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      @endif
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
   
    @if($name=='shop.index'||$name=='shop.goods')
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});  
	</script>
  @endif
  @if($name=='shop.goods')
    <script src="/static/index/js/jquery.spinner.js"></script>
    <script>
    $('.spinnerExample').spinner({});
     </script>
  @endif


  @if($name=='shop.car')
        <!--jq加减-->
     <script src="/static/index/js/jquery.spinner.js"></script>
    <script>
    $('.spinnerExample').spinner({});

  @if($name=='shop.car'){
    @foreach($checkedbuynumber as $k=>$v)
    $("#buy_"+{{$k}}).val({{$v}});
    @endforeach
   
  }
   @endif
   </script>
   @endif
  </body>
</html>