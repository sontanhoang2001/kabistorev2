<?php
include '../lib/session.php';
Session::init();
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
$CountFile = "index.log";
$CF = fopen($CountFile, "r");
$Views = fread($CF, filesize($CountFile));
fclose($CF);
$Views++;

$CF = fopen($CountFile, "w");
fwrite($CF, $Views);
fclose($CF);

$array_Views = str_split($Views);
$count_arrView = count($array_Views)
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
</head>

<body>
    <canvas class="snow" id="snow" width="100%" height="auto"> </canvas>
    <div id="bg-layer"></div>
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

        <div class="center message">
            Số lượt khách ghé thăm Kabi Music Coffee<br>
            Bản quyền ©2021 Tất cả các quyền thuộc bởi KabiStore
        </div>
    </div>
    <div class="container">
        <img id="app-header" src="image/bg-1.png" alt="Cinque Terre">
        <div id="chatbox">
            <div id="box-contaner">
            <!-- <script id="cid0020000293997923480" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 280px;height: 350px;">{"handle":"kabimusiccoffee","arch":"js","styles":{"a":"0084ef","b":100,"c":"FFFFFF","d":"FFFFFF","k":"0084ef","l":"0084ef","m":"0084ef","n":"FFFFFF","p":"10","q":"0084ef","r":100,"surl":0,"cnrs":"0.35","fwtickm":1}}</script> -->
            </div>
            <div class="message">Đề xuất bài hát vào khung chat...</div>
        </div>
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
                        $i = 1;
                        if ($get_all_music) {
                            while ($result = $get_all_music->fetch_assoc()) {
                                $trackName = $result['trackName'];
                                $trackNames_array[] = $trackName;
                                $albums_temp =  explode(" - ", $trackName);
                                $albums_array[] =  $albums_temp[1];

                                $trackUrls_array[] = "http://docs.google.com/uc?export=open&id=" . $result['trackUrl'];
                        ?>
                                <img src="http://docs.google.com/uc?export=open&id=<?php echo $albumArtwork = $result['albumArtwork']; ?>" <?php ($i == 1) ? 'class="active"' : '' ?> id="_<?php echo $i ?>">
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
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
<script>
    var numberMusic = <?php echo $i - 2 ?>,
        albums = <?php echo json_encode($albums_array) ?>,
        trackNames = <?php echo json_encode($trackNames_array) ?>,
        albumArtworks = <?php echo json_encode($albumArtworks) ?>,
        trackUrl = <?php echo json_encode($trackUrls_array) ?>;
</script>
<script src="js/controller.js"></script>
</html>