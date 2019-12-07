@include('layout.layout')
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{$book->title}} | 本棚</title>
<link rel="stylesheet" href="jquery.rateyo.css"/>
<p>{{$book->title}}</p>
<p>{{$book->author}}</p>
<p class="rate" rate="{{$book->rate}}"></p>
<p>
    <select name="category">
        @foreach($categories as $category)
            @if($category->id == $book->category)
                <option value="{{$category->id}}" selected>{{$category->type}}</option>
            @else    
                <option value="{{$category->id}}">{{$category->type}}</option>
            @endif
        @endforeach
    </select>
</p>
<textarea name="content" id="content" cols="100" rows="20">{{$book->content}}</textarea><br>
<span id="res"></span>
<button id="update" serial="{{ $book->id }}" class="btn btn-light">更新</button>
<script src="jquery.js"></script>
<script src="jquery.rateyo.js"></script>
<script>
$(function(){
   var rate = $('.rate').attr('rate');
   console.log(rate);
   $(".rate").rateYo({
        
        rating:rate,
        fullStar: true,
        numStars: 5,
        readOnly: true,
        ratedFill: "#00FF00"
        
    });
    
    $('#update').on('click',function(){
        var content = $('textarea[name="content"]').val();
        var serial = $(this).attr('serial'); 
        var category = $('[name=category]').val();
        var json = {"id":serial,
                    "content":content,
                    "category":category
                    };
        console.log(json);
        $.ajaxSetup({
        　　headers: {
        　　　'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        　　}
    　  });
        $.ajax({
            url:"../update",
            type:"post",
            contentType: "application/json",
            data:JSON.stringify(json),
            dataType:"json",
            success:function(data){
                $("#res").text("更新しました。")
             }
      }) 
    });
});
</script>