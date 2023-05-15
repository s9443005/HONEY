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
                <div class='m-1 p-1'>將圖檔名存在DB，結合最基本的BT5.2官方carousel範例</div>
                    <?php include "connectDB.php"; 
                    $sql = "select * from carousel;";

                    /* 以下2行輪播DIV */
                    echo '<div id="carouselExampleCaptions" class="carousel slide col-6" data-bs-ride="false"><!--輪播BEGIN-->';
                    echo '<div class="carousel-indicators">';
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>';
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>';
                    echo '</div>';
                    echo '<div class="carousel-inner"><!--輪播內部BEGIN-->';
                    
                    /* 以下2行輪播項目 */
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        $ifFirstImage = true;
                        while ($row = $result->fetch_assoc()){
                            if ($ifFirstImage == true){
                                echo '<div class="carousel-item active"><!--輪播ITEM_BEGIN-->';
                                $ifFirstImage = false;
                            } else {
                                echo '<div class="carousel-item">';
                            }
                            echo '<img src="images/' . $row['imgFileName'] . '" class="d-block w-100" alt="' . $row["imgDescription"] . '">';
                            echo '<div class="carousel-caption d-none d-md-block">';
                            echo '<h6></h6>';
                            echo '<p>' . $row["imgDescription"] . '</p>';
                            echo '</div>';
                            echo '</div><!--輪播ITEM_END-->';
                        }
                    }
                    else{echo "錯誤！";}
                    ?>



                    <?php include "disconnectDB.php"; ?>

                    </div><!--輪播內部END-->
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>                    
                </div><!--輪播END-->
            </div><!-- 邊欄右END -->
        </div><!-- row結束-->
    </div><!-- container結束-->
</body>

</html>