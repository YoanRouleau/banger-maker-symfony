
import { _ } from "./js/forbidden-function.js"
// import {Tone} from "/node_modules/tone/build/Tone.js";
const keynotes = ["C3","Db3","D3","Eb3","E3","F3","Gb3","G3","Ab3","A3","Bb3","B3","C4","Db4","D4","Eb4","E4","F4","Gb4","G4","Ab4","A4","Bb4","B4","C5"]
let song = []
let lastClickedContent = -1
let lastReleasedContent = -1
let toolStickToTime = true
let tempo = 180
window.songtoplay={
    "tempo" : tempo,
    "riff"  : [],
}
window.toolsize = 4 //can be 8 , 4 , 2 ,1
window.song = {
    "tempo" : tempo,
    "riff"  : createSongContainer(256),
}
window.instrument = 1;
window.sampler = getSampler();

document.addEventListener("DOMContentLoaded", () => {
    addCss()
    const playgroundContainer =  document.getElementById("playgroundcontainer")
    createToolContainer(playgroundContainer)



})

function addCss(){
    var link = document.createElement('link');

    // set the attributes for link element
    link.rel = 'stylesheet';

    link.type = 'text/css';

    link.href = '/js/banger-maker/css/widget-style.css';

    // Append link element to HTML head
    document.body.appendChild(link);
}

/**
 *
 * @param customsongfile
 * @param tempo
 * @param song
 */
function replaySong() {
    if (document.getElementById("play-loop").classList.contains("on")) {
        setTimeout(function () {
            replaySong()

        }, (1000 / window.song["tempo"]) * window.song["riff"].length * 8);
        playWithSampler()

    }
}

/**
 *
 * @param container
 */
function createToolContainer(container){
    const toolcontainer = _("div",container,{id: "toolcontainer"})


    const buttonplayinvisible = _("button",toolcontainer,{id:"invisible-button-play",classes:"invisible-button"})
    buttonplayinvisible.addEventListener("click",() => {
        playSongWithInstrument()
    })
    const buttonchangeinstrumentinvisible = _("button",toolcontainer,{id:"invisible-button-instr",classes:"invisible-button"})
    buttonchangeinstrumentinvisible.addEventListener("click",() => {
        window.sampler = getSampler();

    })

}

/**
 *
 * @param customfile
 * @param instrument
 */

function playmusic(instrument){

    let synth = window.sampler
    let now = Tone.now()
    let tempo = window.song["tempo"]
    let interval = 60/tempo/8
    let count = now
    let notesArray =  window.song["riff"]

    for (let noteArray in notesArray){

        let myNoteArray = notesArray[noteArray]
        if (myNoteArray.length > 0)
        {
            for (let note in myNoteArray)
            {
                let mynote = myNoteArray[note]
                if (mynote[0] == "+")
                {
                    //synth.triggerAttack(mynote[1]+mynote[2], count)
                    playnote(synth,mynote.substring(1),count)
                    count += 0.00000000000000000000001
                }
                else if (mynote[0]=="-")
                {
                    //synth.triggerAttack(mynote[1]+mynote[2], count)
                    stopnote(synth,mynote.substring(1),count)
                    count += 0.00000000000000000000001
                }
            }
        }
        count+=interval
    }
}


function playWithInstrument(){
    playmusic(window.sampler)
}

function getSampler() {
    if (window.instrument==1) {
        //piano
        return new Tone.Sampler({
            urls: {
                C1: "pianoC1.mp3",
                C2: "pianoC2.mp3",
                C3: "pianoC3.mp3",
                C4: "pianoC4.mp3",
            },
            baseUrl: "../samples/piano/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    } else if (window.instrument==2) {
        return new Tone.Sampler({
            urls: {
                C1: "brassC1.mp3",
                C2: "brassC2.mp3",
                C3: "brassC3.mp3",
                C4: "brassC4.mp3",
            },
            baseUrl: "../samples/brass/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    } else if (window.instrument==3) {
        return new Tone.Sampler({
            urls: {
                C1: "epianoC1.mp3",
                C2: "epianoC2.mp3",
                C3: "epianoC3.mp3",
                C4: "epianoC4.mp3",
            },
            baseUrl: "../samples/epiano/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    } else if (window.instrument==4) {
        return new Tone.Sampler({
            urls: {
                C1: "synth1C1.mp3",
                C2: "synth1C2.mp3",
                C3: "synth1C3.mp3",
                C4: "synth1C4.mp3",
            },
            baseUrl: "../samples/synth1/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    } else if (window.instrument==5) {
        return new Tone.Sampler({
            urls: {
                C1: "synth2C1.mp3",
                C2: "synth2C2.mp3",
                C3: "synth2C3.mp3",
                C4: "synth2C4.mp3",
            },
            baseUrl: "../samples/synth2/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();

    } else if (window.instrument==6) {
        return new Tone.Sampler({
            urls: {
                C1: "synthbassC1.mp3",
                C2: "synthbassC2.mp3",
                C3: "synthbassC3.mp3",
                C4: "synthbassC4.mp3",
            },
            baseUrl: "../samples/synthbass/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    }
    else if (window.instrument==7) {
        return new Tone.Sampler({
            urls: {
                C1: "violonsPizC1.mp3",
                C2: "violonsPizC2.mp3",
                C3: "violonsPizC3.mp3",
                C4: "violonsPizC4.mp3",
            },
            baseUrl: "../samples/violonsPiz/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    }
    else if (window.instrument==8) {
        return new Tone.Sampler({
            urls: {
                C1: "violonsC1.mp3",
                C2: "violonsC2.mp3",
                C3: "violonsC3.mp3",
                C4: "violonsC4.mp3",
            },
            baseUrl: "../samples/violons/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    }
    else if (window.instrument==9) {
        return new Tone.Sampler({
            urls: {
                C2: "xyloC2.mp3",
                C3: "xyloC3.mp3",
                C4: "xyloC4.mp3",
                C5: "xyloC5.mp3",

            },
            baseUrl: "../samples/xylo/",
            onload: () => {

                //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
            }
        }).toDestination();
    }
}
/**
 *
 * @param customfile
 */

export function playSongWithInstrument(){
    song = window.songtoplay
    const synth = window.sampler

    let now = Tone.now()
    let tempo = song["tempo"]
    let interval = 60/tempo/8
    let count = now
    let notesArray =  song["riff"]

    for (let noteArray in notesArray){

        let myNoteArray = notesArray[noteArray]
        if (myNoteArray.length > 0)
        {
            for (let note in myNoteArray)
            {
                let mynote = myNoteArray[note]
                console.log(mynote[0])
                if (mynote[0] == "+")
                {
                    //synth.triggerAttack(mynote[1]+mynote[2], count)
                    playnote(synth,mynote.substring(1),count)
                    count += 0.00000000000000000000001
                }
                else if (mynote[0]=="-")
                {
                    //synth.triggerAttack(mynote[1]+mynote[2], count)
                    stopnote(synth,mynote.substring(1),count)
                    count += 0.00000000000000000000001
                }
            }
        }
        count+=interval
    }

}

/**
 *
 * @param customfile
 */
function playWithSampler(){
    const sampler = new Tone.Sampler({
        urls: {
            A3: "A1.mp3",
            A4: "A2.mp3",
        },
        baseUrl: "https://tonejs.github.io/audio/casio/",
        onload: () => {
            playmusic(sampler)
            //sampler.triggerAttack(["C1", "E1", "G1", "B1"],1);
        }
    }).toDestination();
}

/**
 *
 * @param synth
 * @param note
 * @param starttime
 */
function playnote(synth,note,starttime){
    synth.triggerAttack(note, starttime)

}

/**
 *
 * @param synth
 * @param note
 * @param endtime
 */
function stopnote(synth,note,endtime){
    console.log("stop" + note)
    synth.triggerRelease(note,endtime)
}

/**
 *
 * @param length
 * @returns {[]}
 */
function createSongContainer(length){
    let tempArray = []
    for (let i = 0; i < length; i++){
        tempArray.push([])
    }
    return tempArray
}

/**
 *
 * @param length
 * @param keynotes
 */
function createPlayground(length,keynotes){

    let previewsynth = new Tone.PolySynth(Tone.Synth).toDestination();
    let playground = document.querySelector("#playground")
    let indexes = document.querySelector("#indexes")
    //ajout des indexes (en haut )
    _("div",indexes,{text:"time",classes:"firstTableItem"})
    for (var i = 0; i < length; i++){
        var text = null
        if (i%8 == 0)
            text =i/8
        _("div",indexes,{text:text,classes:"indexItem"})
    }


    for (let note in keynotes){
        //on génère les lignes qui vont contenir les notes
        let noteContainer = _("div",playground,{classes:"note-container"})
        //on ajoute les notes en début de ligne (maybe a rendre fixed sur le téco)
        _("div",noteContainer,{text:keynotes[note],classes:"noteItem"})

        for (let i = 0; i < length; i++){
            let classes ='timeItem'
            if (i%8 == 0)
                classes+=' noire'
            if (i%4 == 0)
                classes+=' croche'
            if (i%2 == 0)
                classes+=' doublecroche'
            //append timeItems
            let addclass = ""
            if (keynotes[note].length >2)
                addclass = " tileNoire"

            let noteTile = _("p",noteContainer,{classes:classes+" "+keynotes[note]+" "+i+" js-noMenu"+addclass})
            noteTile.addEventListener("mousedown",(e)=>{
                if (e.button==0){
                    lastClickedContent = [keynotes[note],i]


                    previewsynth.triggerAttackRelease(keynotes[note],"8n")
                }
                else if (e.button == 2){
                    removeNote(keynotes[note],i)
                    lastClickedContent = -1

                }
            })


            noteTile.addEventListener("mouseup",(e)=>{
                //if (e.button==0) {
                if (lastClickedContent != -1){
                    lastReleasedContent = [keynotes[note], i]
                    addnote(lastClickedContent, lastReleasedContent)
                }
            })
        }
    }
    [...document.querySelectorAll(".js-noMenu")].forEach( el =>
        el.addEventListener('contextmenu', e => e.preventDefault())
    );

}

/**
 *
 * @param lastClicked
 * @param lastReleased
 * @param song
 */
function addnote(lastClicked,lastReleased){
    //si on clique sur un endroit
    console.log(lastClicked[0])
    if (lastClicked[0] == lastReleased[0] && lastClicked[1] == lastReleased[1]) {
        if(!document.getElementsByClassName(lastClicked[0]+" "+lastClicked[1])[0].classList.contains("played")) {
            if (toolStickToTime == true) {

                let startindex = lastClicked[1];
                let searchclass = ""
                switch (window.toolsize ) {
                    case 1:
                        searchclass = "timeItem"
                        break;

                    case 2:
                        searchclass = "doublecroche"
                        break;

                    case 4:
                        searchclass ="croche"
                        break;

                    case 8:

                        searchclass ="noire"
                        break;
                }
                while(!document.getElementsByClassName(lastClicked[0]+" "+startindex)[0].classList.contains(searchclass)){
                    startindex--;
                }
                noteedit(startindex,startindex+window.toolsize ,lastClicked[0])


            }
            else {
                if(!document.getElementsByClassName(lastClicked[0]+" "+(lastClicked[1]+window.toolsize -1))[0].classList.contains("played"))
                    noteedit(lastClicked[1],lastClicked[1]+window.toolsize ,lastClicked[0])
            }
        }
    }
}

/**
 *
 * @param indexmin
 * @param indexmax
 * @param note
 * @param song
 */
function noteedit(indexmin,indexmax,note){
    console.log(window.song)
    let song =window.song["riff"]
    for (let i = indexmin; i < indexmax; i++) {
        document.getElementsByClassName(note + " " + i)[0].classList.add("played")
    }
    song[indexmin].push("+" + note)
    song[indexmax - 1].push("-" + note)
}

/**
 *
 * @param note
 * @param index
 * @param song
 */
function removeNote(note,index){
    let song =window.song["riff"]
    while(!song[index].includes("+"+note)){
        document.getElementsByClassName(note+" "+index)[0].classList.remove("played")
        index--;
    }
    document.getElementsByClassName(note+" "+index)[0].classList.remove("played")
    song[index].splice(song[index].indexOf("+"+note),1)
    while(!song[index].includes("-"+note)){

        index++;
        document.getElementsByClassName(note+" "+index)[0].classList.remove("played")
    }
    song[index].splice(song[index].indexOf("-"+note),1)
}
