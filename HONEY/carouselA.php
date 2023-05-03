<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "htmlhead.php"; ?>
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
                <h5 class='m-1 p-1'>筆記</h5>
                <div class='m-1 p-1'>將圖檔名存在DB，結合最基的的BT5.2官方carousel範例</div>
                    <?php include "connectDB.php"; 
                    $sql = "select * from carousel;";

                    /* 以下2行輪播DIV */
                    echo '<div id="carouselExampleSlidesOnly" class="carousel slide col-4" data-bs-ride="carousel"><!--輪播BEGIN-->';
                    echo '<div class="carousel-inner"><!--輪播內部BEGIN-->';
                    
                    /* 以下2行輪播項目 */
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $ifFirstImage = TRUE;
                        while ($row = $result->fetch_assoc()){
                            if ($ifFirstImage == TRUE){
                                echo '<div class="carousel-item active">';
                                $ifFirstImage = FALSE;
                            } else {
                                echo '<div class="carousel-item">';
                            }
                            echo '<img src="images/' . $row['imgFileName'] . '" class="d-block w-100" alt="' . $row['imgDescription'] . '">';
                            echo '</div>';
                        }
                    }
                    else{echo "錯誤！";}
                    ?>



                    <?php include "disconnectDB.php"; ?>

                    </div><!--輪播內部END-->
                </div><!--輪播END-->
            </div><!-- 邊欄右END -->
        </div><!-- row結束-->
    </div><!-- container結束-->
</body>

</html>