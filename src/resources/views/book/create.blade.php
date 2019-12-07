@include('layout.layout')
<title>本棚登録</title>
<link rel="stylesheet" href="jquery.rateyo.css"/>
<div class="container" style="margin-top:15px;">
<style>
</style>
    <div id="app2">
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">題名</label>
            <input type="text" v-model="title" class="form-control" id="title" name="title" placeholder="Enter title">
            <p>@{{title}}<p>
        </div>
        <div class="form-group">
            <label for="author1">著者</label>
            <input type="text" v-model="author" class="form-control" id="author1" name="author" placeholder="enter author">
            <p>@{{author}}</p>
        </div>  
        <div class="form-group">
            <label for="content1">メモ</label><br>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                入力
            </button><br>
        </div> 
        <div class="form-group">
            <label for="content1">カテゴリー</label><br>
            <select name="category">
                <option value="" selected disabled>カテゴリーを選択してください</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->type}}</option>
                @endforeach
            </select>
        </div> 
        <div class="form-group">
            <label for="rate">評価</label><br>
            <div id="rateYo" name="rate"></div>
            <input type="hidden" id="rate" name="rate" value="">
        </div> 
        <div class="form-group">
            <label for="picture1">画像</label><br>
            <input type="file" id="picture1" name="image"><br>
            <img id="img1" style="width:100px;height:100px;" />
        </div>
        <button type="submit" class="btn btn-primary" align="right">登録</button>

        <!-- モーダル -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">メモ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <textarea name="content" id="content" v-model="typedText" cols="90" rows="20"></textarea><br>
            </div>
            <div class="modal-footer">
                <p>現在@{{ charaCount }}文字</p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
            </div>
        </div>
        </div>
        </div>
        
    </form>

<script src="jquery.js"></script>
<script src="jquery.rateyo.js"></script>
<script>
    $(function(){
    $("#rateYo").rateYo({
        rating: 0,
        fullStar: true,
        numStars: 5,
        ratedFill: "#E74C3C"
        
    });
    $("#rateYo").on('click',function(){
        var $rateYo = $("#rateYo").rateYo();
        var rating = $rateYo.rateYo("rating");
        $('#rate').val(rating);
        
    });
    // $('#content').keyup(function(){
    //     var count = $(this).val().length;
    //     $('.show-count').text(count);
    //     });
    $('#picture1').change(function(e){
        //ファイルオブジェクトを取得する
        var file = e.target.files[0];
        var reader = new FileReader();
    
        //画像でない場合は処理終了
        if(file.type.indexOf("image") < 0){
        alert("画像ファイルを指定してください。");
        return false;
        }
    
        //アップロードした画像を設定する
        reader.onload = (function(file){
        return function(e){
            $("#img1").attr("src", e.target.result);
            $("#img1").attr("title", file.name);
        };
        })(file);
        reader.readAsDataURL(file);
 
    });
});
</script>
<script>
new Vue({
    el: '#app2',
    data: {
        typedText: '',
        title: '',	
        author: '',
        selected: '',
    },
    computed: {
        charaCount: function() {
            return this.typedText.length;
        }
    }
})
</script>