var tag = document.createElement('script');
var id = getParameter("id");
// var id = "9bAiXJoNdy0";
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
var start_time = [];
var end_time = [];

//add time to an array
function getcontext(start,end){
  //context = data;
  // console.log(data);
  start_time.push(start);
  end_time.push(end);
}

//load video
function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    //height: '100%',
    width: '100%',
    videoId: id,
    events: {
      'onReady': onPlayerReady,
      // 'onStateChange': onPlayerStateChange
    }
  });
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
  // event.target.loadVideoById("oWP9Riq-ZBg", 5,"large");
  // event.target.playVideo();
  setInterval(function(){ for (var i = 0; i < 20; i++) {
    if (player.getCurrentTime() > start_time[i] / 1000 && player.getCurrentTime() < end_time[i] / 1000) {
      if (i!=0) document.getElementById('ts' + (i)).style.backgroundColor = "white";
      document.getElementById('ts' + (i + 1)).style.backgroundColor = "lightgray";
    }
  } }, 500);
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
// var done = false;
//
// function onPlayerStateChange(event) {
//
//   if (event.data == YT.PlayerState.PLAYING ) {
//
//     for (var i = 1; i <= 20; i++) {
//       document.getElementById('ts' + i).style.backgroundColor = "white";
//     }
//     for (var i = 0; i < 20; i++) {
//       if (player.getCurrentTime() >= context[i].start_time / 1000 && player.getCurrentTime() <= context[i].end_time / 1000) {
//         document.getElementById('ts' + (i + 1)).style.backgroundColor = "lightgray";
//       }
//     }
//   }
// }


function stopVideo() {
  player.stopVideo();
}

//control the play buttons
function play_context_one(index,start,end) {

  player.loadVideoById(id, start/1000,"large");
  setTimeout(pauseVideo, end - start);
  for (var i = 1; i <= 20; i++) {
    document.getElementById('ts' + i).style.backgroundColor = "white";
  }
  document.getElementById('ts' + index).style.backgroundColor = "lightgray";
}

function pauseVideo() {
  player.pauseVideo();
  for (var i = 1; i <= 20; i++) {
    document.getElementById('ts' + i).style.backgroundColor = "white";
  }
}

//parse the website to get video id
function getParameter(param)
{
    var query = window.location.search;
    var iLen = param.length;
    var iStart = query.indexOf(param);
    if (iStart == -1)
    　         return "";
    iStart += iLen + 1;
    var iEnd = query.indexOf("&", iStart);
    if (iEnd == -1)
    　         return query.substring(iStart);

    return query.substring(iStart, iEnd);
}
