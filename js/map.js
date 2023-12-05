// 創建一個 XMLHttpRequest 物件，處理後端部分
var xhr = new XMLHttpRequest();

// 定義請求的 URL 和方法（GET 或 POST）
var url = 'Map.php';
var method = 'GET';

// 定義 JSON 數據的全局變數
var jsonData;

// 發起 AJAX 請求
xhr.open(method, url, true);
xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            // 請求成功，處理返回的數據
            var responseData = xhr.responseText;

            // 解析 JSON 數據
            jsonData = JSON.parse(responseData);

            // 在此處執行對解析後的 JSON 數據的操作
            var positions = [];
            var icons = {};
            for (var i = 0; i < jsonData.length; i++) {
                var latitude = parseFloat(jsonData[i].lat);
                var longitude = parseFloat(jsonData[i].lng);
                var type = jsonData[i].kind;

                positions.push({ lat: latitude, lng: longitude });

                // 添加標記類型到圖標對象
                if (!icons[type]) {
                    icons[type] = {
                        icon: "images/mark_" + type + ".png",
                    };
                }
            }

            // 將經緯度和圖標類型傳遞給初始化地圖的函數
            var mapData = {
                positions: positions,
                icons: icons,
            };
            initMap(mapData);
        } else {
            // 請求失敗，處理錯誤情況
            console.error('AJAX request failed. Status:', xhr.status);
        }
    }
};
xhr.send();

// 定義 initMap 函數
function initMap(mapData) {
    // 檢查 mapData 是否存在
    if (!mapData || !mapData.positions || !mapData.icons) {
        console.error('Invalid mapData');
        return;
    }

    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 24.179024, lng: 120.649595 }, // 設置地圖中心點，根據實際情況修改
        zoom: 15, // 設置地圖縮放級別，根據實際情況修改
    });

    // 循環遍歷位置數據，創建標記並在地圖上顯示
    for (var i = 0; i < mapData.positions.length; i++) {
        var marker = new google.maps.Marker({
            position: mapData.positions[i],
            icon: mapData.icons[jsonData[i].kind].icon,
            animation: google.maps.Animation.BOUNCE,
            draggable: true,
            map: map,
        });
    }
}
