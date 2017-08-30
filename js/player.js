var audio;
var playlist;
var tracks;
var current;
var previous;
var current_track;
var previous_track;
var ntracks;
function initaudio(){
    audio=$("audio");
    playlist=$("#playlist");
    ntracks=$("[id^=item-]").length
    audio[0].volume=1;
    current=0;
    previous=ntracks-1;
    current_track=playlist.find("#item-0");
    previous_track=playlist.find("#item-"+previous);
    runaudio(current_track, audio[0],false);
    $("#panelplayer").height("50px");
    $("[id^=item-]").click(function(e){
        e.preventDefault();
        previous=current;
        previous_track=current_track;
        remove_play(previous_track);
        current_track=$(this);
        current=current_track.parent().index();
        runaudio(current_track, audio[0]);
    });
    audio[0].addEventListener("ended",function(e){
        playnext();
    });
    audio[0].addEventListener("pause",function(e){
        $("#playing").hide();
        $("#panelplayer").height("50px");
    });
    audio[0].addEventListener("play",function(e){
        $("#playing").show();
        $("#panelplayer").height("auto");
    });
};
function playnext(){
    previous=current;
    previous_track=current_track;
    remove_play(previous_track);
    current++;
    current_track=playlist.find("#item-"+current);
    if(current_track.length==0){
        current=0;
        current_track=playlist.find("#item-0");
    }
    runaudio($(current_track),audio[0]);
}
function playprevious(){
    previous=current;
    previous_track=current_track;
    remove_play(previous_track);
    current--;
    current_track=playlist.find("#item-"+current);
    if(current<0){
        current=ntracks-1;
    }
    current_track=playlist.find("#item-"+current);
    runaudio($(current_track),audio[0]);
}
function remove_play(item){
    isp=$(item.find(".isplaying"));
    isp.html("");
}
function runaudio(item, player,play=true){
    isp=$(item.find(".isplaying"))
    isp.html("<i class='fa fa-play' aria-hidden='true'></i>");
    podcast=$(item.find(".podcast"));
    $("#podcast").text(podcast.text());
    track=$(item.find(".track"));
    $("#track").text(track.text());
    link=$(item.find('a'));
    player.src=link.attr("href");
    par=link.parent();
    par.addClass("active").siblings().removeClass("active");
    audio[0].load();
    if(play==true){
        console.log(play);
        audio[0].play();
    }
}
$(document).ready(function(){ 
    console.log($("[id^=item-]").length);
    $("#right").bind("click", function(e) {
        playnext();
    });
    $("#left").bind("click", function(e) {
        playprevious();
    });
    $("#playing").hide();
    initaudio();
});