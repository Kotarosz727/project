@include('layout.layout')
<title>一覧 | 本棚</title>
<style>
body {
  position:relative;
}
 
.modal {
  position:absolute;
  width:100%;
  height:100vh;
  top:0;
  left:0;
  display:none;
  cursor: grab;
}
 
.overLay {
  position: absolute;
  top: 60px;
  left: 0;
  background: rgba(200,200,200,0.9);
  width: 100%;
  height: 70%;
  z-index: 10;
}
 
.modal .inner {
  position:absolute;
  z-index:11;
  top:50%;
  left:50%;
  transform:translate(-50%,-50%);
}
.modalClose {
  cursor: default;
}
.img-top{
  cursor: pointer;
}
</style>
<div id="app">
            <example-component></example-component>
        </div>
<div id="app3">
<div class="container-fluid">

  <div class="row">
    @foreach($lists as $list)
    <div class="col-md-3">
    <div class="col h-100">
      <div class="card" style="width:18rem;margin-top:11px;" >
        <img class="img-top" serial="#mordal{{$list->id}}" src="{{$list->picture}}">
        <div class="card-body">
        <b-button variant="outline-primary"><a href="/book/detail/{{$list->id}}">詳細</a></b-button>
          <span style="float:right">{{ $list->rate }}</span><span id="rate" class="rate" style="float:right"></span>
        <!-- modal -->
          <div class="modal" id="mordal{{$list->id}}">
            <div class="overLay modalClose"></div>
              <div class="inner">
                <p>{{$list->title}}</p>
                <p>{{$list->author}}</p>
                <textarea name="" id="" cols="30" rows="13">{{$list->content}}</textarea><br>
                <p class="modalClose" serial="#mordal{{$list->id}}">閉じる</p>
              </div>
            </div>
          </div>
        <!-- modal -->
      </div> 
    </div>  
    </div>  
    @endforeach
  </div>  
</div>  
</div>

<script>
$(function(){
    $(".rate").rateYo({
        rating: 1,
        maxValue: 1,
        numStars: 1,
        readOnly: true,
        starWidth: "25px",
        ratedFill: "#E74C3C"
        // $('#rate').val(rating);
    });
    $(".img-top").mousedown(function(){
        var navClass = $(this).attr("class"),
            href = $(this).attr("serial");
        $(href).fadeIn(); 
        $(href).draggable();
        // $(href).resizable();
    });
    $(".modalClose").click(function(){
      href = $(this).attr("serial");
      $(href).fadeOut();
    });    
});
</script>
<script>
new Vue({
    el: '#app3',
})
</script>
<!-- <script src="{{ asset('/js/app.js') }}"></script> -->