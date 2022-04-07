var audio = document.getElementById("audioPlayer");
var isPlaying = false;

//de naam van de functie spreekt voor zichzelf
function toggleMusic() {
  if (isPlaying) {
    audio.pause()
  } else {
    audio.play();
  }
};
audio.onplaying = function() {
  isPlaying = true;
};
audio.onpause = function() {
  isPlaying = false;
};

//functie om het lied te skippen
function skipMusic() {
  //geen idee hoe je een audio file moet skippen, dus dan maar 1000000 seconden forwarden!
  audio.currentTime += 1000000;
}

//om het liedje te resetten
function resetMusic() {
  audio.pause();
  audio.currentTime = 0;
}

//dit stukje code is van youtube.com/MicroTechTutorials. gebruikt, want dit was nog wel erg geavanceerd
function audioPlayer(){
  var currentSong = 0;
  $("#audioPlayer")[0].src = $("#playlist li a")[0];
  $("#audioPlayer")[0].play();
  $("#playlist li a").click(function(e){
     e.preventDefault(); 
     $("#audioPlayer")[0].src = this;
     $("#audioPlayer")[0].play();
     $("#playlist li").removeClass("current-song");
      currentSong = $(this).parent().index();
      $(this).parent().addClass("current-song");
  });
  
  $("#audioPlayer")[0].addEventListener("ended", function(){
     currentSong++;
      if(currentSong == $("#playlist li a").length)
          currentSong = 0;
      $("#playlist li").removeClass("current-song");
      $("#playlist li:eq("+currentSong+")").addClass("current-song");
      $("#audioPlayer")[0].src = $("#playlist li a")[currentSong].href;
      $("#audioPlayer")[0].play();
  });
}