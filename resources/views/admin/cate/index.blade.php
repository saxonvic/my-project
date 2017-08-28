@extends('layouts.layout')
@section('content')
 <!-- 位置 -->
 <div id="position" class="dark_blue15">最新消息 &gt; 分類管理</div>

 <!-- 搜尋 -->
 <div id="search" class="box" style="display: none;">
 </div>

 <!-- 顯示內容 -->
 <div id="bd" class="box">
   <div id="toolbar">
     <a href="{{url('admin/news/category/create')}}" class="btn btn-primary btn-sm">新增</a>
     {{--<a href="javascript:up();"   class="btn btn-info btn-xs">啟用</a>--}}
     {{--<a href="javascript:down();" class="btn btn-info btn-xs">停用</a>--}}
   </div>
   <div id="content">
     <table width="100%" border="0" cellspacing="1" cellpadding="4" class="listT">
       <tr align="center" class="listT_field">
         <td align="left" style="padding-left: 20px">&nbsp;分類名稱</td>
         <td width="20%">排序</td>
         <td width="20%">修改</td>
         <td width="20%">刪除</td>
       </tr>
       @if(count($data) > 0)
       @foreach($data as $v)
       <tr align="center" class="listT_row01 " id="">
           <td align="left" ><i class="fa fa-folder  fa-2x " aria-hidden="true"></i> {{$v->_name}}</td>
         <td>
           <input type="number" min="0" name="sort"  value="{{$v->sort}}" class="size-1 form-control" onchange="changeOrder(this, '{{$v->id}}')">
         </td>
         <td><a href="{{url('admin/news/category/'.$v->id.'/edit')}}" class="fa fa-2x fa-edit text-info"></a></td>
         <td><a href="javascript:void(0)" class="fa fa-trash-o  fa-2x  text-danger" onClick="delCate({{$v->id}})"></a></td>
       </tr>
       @endforeach
       @else
        <tr align="center" class="listT_row01">
             <td colspan="6">目前系統尚無任何資訊</td>
        </tr>
       @endif
       <tr align="center" class="listT_foot">
         <td colspan="6">&nbsp;</td>
       </tr>
     </table>
   </div>
 </div>
<script>
    //變更排序
    function changeOrder(obj,id) {
        var cate_order = $(obj).val();
        $.post("{{url('admin/postcategory/changesort')}}",{'_token':'{{csrf_token()}}','id':id,'sort':cate_order},function(data){
            if(data.status == 0){
                layer.msg(data.msg,{icon:6});
            }else{
                layer.msg(data.msg,{icon:5});
            }
        });
    }


    //刪除分類
    function delCate(id) {
        layer.confirm('您確定要刪除這個分類嗎？', {
            btn: ['確定', '取消'] //按钮
        }, function () {
            $.post("{{url('admin/news/category')}}/"+id ,{'_method':'delete','_token':"{{csrf_token()}}"} ,function (data) {
                if(data.status == 0){
                    layer.msg(data.msg,{icon:6});
                    location.reload();
//                    setTimeout("location.reload()", 1000);等待 1 秒重新整理
                }else{
                    layer.msg(data.msg,{icon:5});
                }
            })
        }, function () {

        });
    }
</script>

@endsection