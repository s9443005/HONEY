<!DOCTYPE html>
<html>

<head>
    <?php include "htmlhead.php"; ?>
    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit
        }

        body {
            background-color: gainsboro;
        }

        .div {
            width: 465px;
            height: 120px;
            background-color: rgb(66, 118, 160);
            position: relative;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .div-all {
            width: 415px;
            height: 120px;
            background: white;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
        }

        .div-img {
            width: 135px;
            height: 100%;
            background-color: gainsboro;
            float: left;
        }

        .div-img img {
            width: 100%;
        }

        .div-cont {
            width: 240px;
            height: 100%;
            float: left;
            margin-left: 10px;
            overflow: hidden;
        }

        .div-cont h4 {
            margin-top: 0px;
            margin-bottom: 0px;
        }

        #btnPrev {
            width: 30px;
            height: 30px;
            background-image: url("images/icon/prev.png");
            background-size: cover;
            position: absolute;
            top: 40%;
            left: -5px;
            z-index: 1;
        }

        #btnNext {
            width: 30px;
            height: 30px;
            background-image: url("images/icon/next.png");
            background-size: cover;
            position: absolute;
            top: 40%;
            right: -10px;
            z-index: 1;
        }
    </style>
        <!--加入PHP code，讀取圖片檔名、圖片描述、圖片資訊BEGIN-->
        <?php 
            include "connectDB.php";
            $sql = "select * from carousel;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                unset($img);
                unset($title);
                unset($info);
                while($row    = $result->fetch_assoc()){
                    $img[]  = $row['imgFileName'];
                    $title[]= $row['imgDescription'];
                    $info[] = $row['imgInfo'];
                }
            }
            echo json_encode($img, JSON_NUMERIC_CHECK);
            include "disconnectDB.php";
        ?><!--加入PHP code，讀取圖片檔名、圖片描述、圖片資訊END-->


        <script>
        // 宣告index用來代表目前是第幾筆記錄，0表示第一筆
        // 共用的變數宣告在所有function之外
        var index = 0;
        //var img = new Array("pic_01.jpg", "pic_02.jpg", "pic_03.jpg");
        //var title = new Array("一中商圈(xx張淑娟)", "逢甲夜市", "旱溪夜市");
        //var info = new Array("位在台中第一中學附近的商圈，滿滿的美食也吸引外地遊客慕名而來。", "逢甲夜市鄰近逢甲大學，蘊含著許多人潮排隊美食。", "比起逢甲夜市與一中商圈聲勢也是越來越浩大。");
        
        /* ↓↓↓↓↓↓↓從PHP傳陣列過來↓↓↓↓↓↓↓ */
        var img     = <?php echo json_encode($img, JSON_NUMERIC_CHECK) ?>;
        var title   = <?php echo json_encode($title, JSON_NUMERIC_CHECK) ?>;
        var info    = <?php echo json_encode($info, JSON_NUMERIC_CHECK) ?>;
        /* ↑↑↑↑↑↑↑從PHP傳陣列過來↑↑↑↑↑↑↑ */

        function toHTML() {
            var hm =
                "<div class='div-all'>" +
                "<a href='#'>" +
                "<div class='div-img'><img src='images/" + img[index] + "'></div >" +
                "<div class='div-cont'>" +
                "<h4>" + title[index] + "</h4>" +
                "<p>" + info[index] + "</p>" +
                "</div>" +
                "</a >" +
                "</div>";
            return hm;
        }

        window.onload = function () {
            //將toHTML()函式取得的夜市資料呈現在#div_cont元素上
            div_cont.innerHTML = toHTML();
            btnPrev.addEventListener("click", fnPrev, false); //onclick="fnPrev()"
            btnNext.addEventListener("click", fnNext, false);
        }

        //按上一篇鈕執行
        function fnPrev() {
            //移往上一筆
            index--;
            // 判斷是否超出第一筆
            if (index < 0) {
                //指定從最後一筆開始
                index = img.length - 1;
            }
            // index = index % img.length;

            //將toHTML()函式取得的夜市資料呈現在#div_cont元素上
            div_cont.innerHTML = toHTML();

        }
        //按下一篇鈕執行
        function fnNext() {
            //移往下一筆
            index++;
            // 判斷是否超出最後一筆
            if (index >= img.length) {
                //指定從第一筆開始
                index = 0;
            }
            // index = index % img.length;
            //將toHTML()函式取得的夜市資料呈現在#div_cont元素上
            div_cont.innerHTML = toHTML();
        }
    </script>


</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- 邊欄左BEGIN -->
            <?php include "sidebarLEFT.php"; ?>
            <!-- 邊欄左ENG -->

            <!-- 邊欄右BEGIN -->
            <div class="col py-3">
                <h1>圖片輪播</h1><hr>
                <p>圖片名稱、圖片描述、圖片資訊，由PHP讀取資料庫得來。</p>
                <div class="div">
                    <div id="div_cont"> </div>
                    <div id="btnPrev">  </div>
                    <div id="btnNext">  </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>