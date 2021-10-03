<?php
include '../lib/session.php';
// Session::init();
include '../lib/database.php';
include '../helpers/format.php';
include '../helpers/helpers.php';
include '../classes/musiccoffee.php';

$db = new Database();
$fm = new Format();
$music = new musiccoffee();

// get music on db
$get_all_music = $music->getMusic();

// get CountFile
$url = "https://kabistore.tk/api/counter-api.html";
$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
$result = json_decode($response, true);
if ($result != null) {
    foreach ($result as $key) {
        $count_arrView = $key['count_arrView'];
        $array_Views = $key['row_array'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Trang web coffee online miễn phí lấy bối cảnh TP.Cần Thơ miền tây bạn sẽ được nghe nhạc miễn phí và có chức năng chat nhóm online">
    <meta name="keywords" content="kabistore coffee music, kabistorecoffeemusic, coffee music, coffee am nhac, coffeeonline , coffee online, coffe music, coffee âm nhạc, coffee 4.0, quán coffee online, quán coffee bật nhất cần thơ, cà phê âm nhạc online">
    <!-- <meta name="author" content=""> -->
    <meta name="facebook:title" content="fan page của chúng tôi https://www.facebook.com/ilovekabistore">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/coffee-cup-icon.ico">

    <title>Music Coffee</title>
    <link rel="stylesheet" href="~/../../css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7018934731832878" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <canvas class="snow" id="snow" width="100%" height="auto"> </canvas>
    <div id="bg-layer"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex justify-content-center align-items-center p-2">
                <div class="inforweb">
                    Số lượt khách ghé thăm Kabi Music Coffee<br>
                    Bản quyền ©2021 Tất cả các quyền thuộc bởi KabiStore
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center align-items-center">
                <div id="Counter">
                    <div class="center">
                        <?php
                        if ($count_arrView < 5) {
                            for ($i = 0; $i <= $count_arrView; $i++) {
                        ?>
                                <span>0</span>
                            <?php
                            }
                        }
                        for ($i = 0; $i <= $count_arrView - 1; $i++) {
                            ?>
                            <span><?php echo $array_Views[$i] ?></span>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <img id="app-header" src="image/bg-1.png" alt="Cinque Terre">
            <div class="col-md-8 col-sm-12">
                <div id="app-cover">
                    <div id="bg-artwork"></div>
                    <div id="player">
                        <div id="player-track">
                            <div id="album-name"></div>
                            <div id="track-name"></div>
                            <div id="track-time">
                                <div id="current-time"></div>
                                <div id="track-length"></div>
                            </div>
                            <div id="s-area">
                                <div id="ins-time"></div>
                                <div id="s-hover"></div>
                                <div id="seek-bar"></div>
                            </div>
                        </div>

                        <div id="player-content">
                            <div id="album-art">
                                <?php
                                $url = "https://kabistore.tk/api/music-api.html";
                                $client = curl_init($url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response, true);
                                $i = 1;
                                if ($result != null) {
                                    foreach ($result as $key) {
                                        $trackName = $key['trackName'];
                                        $trackNames_array[] = $trackName;
                                        $albums_temp =  explode(" - ", $trackName);
                                        $albums_array[] =  $key[1];
                                        $trackUrls_array[] = "http://docs.google.com/uc?export=open&id=" . $key['trackUrl'];
                                ?>
                                        <img src="http://docs.google.com/uc?export=open&id=<?php echo $albumArtwork = $key['albumArtwork']; ?>" <?php ($i == 1) ? 'class="active"' : '' ?> id="_<?php echo $i ?>">
                                <?php
                                        $albumArtworks[] = "_" . $i;
                                        $i++;
                                    }
                                } else {
                                    echo "Lỗi hệ thống bài hát!";
                                }
                                ?>
                                <div id="buffer-box">Đang tải ...</div>
                                <!-- <div id="buffer-box">Buffering ...</div> -->
                            </div>
                            <div id="player-controls">
                                <div class="control">
                                    <div class="button" id="play-previous">
                                        <i class="fa fa-backward"></i>
                                    </div>
                                </div>
                                <div class="control">
                                    <div class="button" id="play-pause-button">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </div>
                                <div class="control">
                                    <div class="button" id="play-next">
                                        <i class="fa fa-forward"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div id="chatbox">
                    <iframe src="https://www5.cbox.ws/box/?boxid=928764&boxtag=9AAmNb" width="100%" height="450" allowtransparency="yes" allow="autoplay" frameborder="0" marginheight="0" marginwidth="0" scrolling="auto"></iframe>
                    <div class="message">Đề xuất bài hát vào khung chat...</div>
                    <div id="hostServer"><a href="server1">server1 |</a><a href="server2"> server2</a></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="clock">
                    <div class="hours">
                        <div class="first">
                            <div class="number">0</div>
                        </div>
                        <div class="second">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="tick">:</div>
                    <div class="minutes">
                        <div class="first">
                            <div class="number">0</div>
                        </div>
                        <div class="second">
                            <div class="number">0</div>
                        </div>
                    </div>
                    <div class="tick">:</div>
                    <div class="seconds">
                        <div class="first">
                            <div class="number">0</div>
                        </div>
                        <div class="second infinite">
                            <div class="number">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    var numberMusic = <?php echo $i - 2 ?>,
        albums = <?php echo json_encode($albums_array) ?>,
        trackNames = <?php echo json_encode($trackNames_array) ?>,
        albumArtworks = <?php echo json_encode($albumArtworks) ?>,
        trackUrl = <?php echo json_encode($trackUrls_array) ?>;
</script>
<script src="js/controller.js"></script>

</html>