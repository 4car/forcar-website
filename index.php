<?php 
include('inc/header.php');
?>
<style>
  @import url("css/cardimage.css");
  @import url("css/intro.css");
</style>
<?php include('inc/container_i.php');?>
<body>
  <!--introduction-->
  <div class="index-iframe">
    <div class="index-video" >
      <iframe  src="https://www.youtube.com/embed/1OYi6ujXpQE" title="介紹影片" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>
    </div>
    <div class="index-about">
      <p id="about">
      我們的畢業專題主要是開發一款巡軌車，用於巡視軌道的運行狀況，並檢測是否有異常情況。巡軌車的工作內容主要包括以下幾個方面：使用影像辨識技術檢測扣件是否缺失、枕木是否有裂縫、軌道是否彎曲，以及是否存在障礙物。
      此外，我們還使用紅外線技術來判斷軌道是否沉陷。當發現異常情況時，車輛將通過WiFi模組向資料庫回傳GPS座標、異常照片和當時時間。接收到資料後，資料庫會上傳至伺服器並顯示於HTML網頁上。
      巡軌車的實體設計參考了台鐵軌道的寬度，車體長度為50公分，寬度為100公分。車輛使用行動電源驅動高扭力、低轉速的馬達前進。此外，我們還搭載了Jetson NX嵌入式系統，用於記錄異常狀況並向工務人員發出通知。我們的畢業設計旨在利用影像辨識和紅外線感測器等技術，檢測鐵路安全、維持舒適乘車環境，感謝您的關注。
    </div>
  </div>
  <div class="table" align="center" >
    <div class="notification">
        <div class="type">
            <img src="images/fastener.png" alt="fastener" class="image">
            <span>扣件遺失</span>
        </div>
    </div>

    <div class="notification">
        <div class="type">
            <img src="images/sleeper.png" alt="sleeper" class="image">
            <span>枕木辨識</span>
        </div>
    </div>
    
    <div class="notification">
        <div class="type">
            <img src="images/railway.png" alt="curved" class="image">
            <span>軌道彎曲</span>
        </div>
    </div>

    <div class="notification">
        <div class="type">
            <img src="images/obstacle.png" alt="obstacle" class="image">
            <span>外物入侵</span>
        </div>
    </div>
</div>
        
<?php include('inc/footer.php');?>