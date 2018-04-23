<?php
//get youtube id
if(isset($_GET["id"]) && $_GET["id"]!="")
{
    $id = $_GET["id"];
}

//read json file
$json = $id;
$handle = fopen("./context/".$json.".json","rb");
$context = "";
while (!feof($handle)) {
        $context .= fread($handle, 10000);
}
fclose($handle);
$context = json_decode($context,true);

//load the transcripts
function loadcontext($i,$start,$end,$text){
  $html = "";
  $html.= '
  <tr>
    <td class="cor_sent hide">
      <a class="btn btn-mini" <i class="icon-pencil"></i></a>
    </td>
    <td class="align-top" width="25">
      <a href="javascript:;" onclick="play_context_one('.$i.','.$start.','.$end.');"><i class="fa fa-play-circle-o"></i></a>
    </td>
    <td>
      <span id="ts'.$i.'">'.$text.'</br></span>
    </td>
  </tr>';
  echo $html;
}

echo'

<html lang="zh-TW">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Voicetube Implement</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- Bootstrap core CSS -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="js/IFrame.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>';

//send time to js
  for($i= 0 ; $i <20 ; $i++){
      echo '<script> getcontext('.$context[$i]["start_time"].','.$context[$i]["end_time"].'); </script>';
  }
  echo '<nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">VoiceTube</a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" >精選頻道 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">中英文雙字幕影片</a></li>
                      <li><a href="#">深度英文演講</a></li>
                      <li><a href="#">TOEIC 雅思考試</a></li>
                    </ul>
                  </li>
                  <li><a href="#">匯入影片</a></li>
                  <!-- <li><a href="#" target="_blank">| &nbsp; HERO 課程 <span id="nred-badge" class="animated bounceIn hero-header-badge">Hot</span></a></li> -->
                </ul>
              </div><!-- /.navbar-collapse -->
          </div>
</nav>
  <div id="con" class="container">
    <div class="row ">
      <div class="col-lg-7 rows">
        <div class="col-12" id="player" ></div>
      </div>
      <div id="ts" class="col-lg-5 ">
        <div>
          <tbody>
  ';
  //send time and text to js
            for ($i = 1 ; $i <= 20 ; $i++){
              loadcontext($i,$context[$i-1]["start_time"],$context[$i-1]["end_time"],$context[$i-1]["text"]);
            }

echo'
          </tbody>
        </div>

      </div>
    </div>
  </div>


</body>

</html>';
?>
