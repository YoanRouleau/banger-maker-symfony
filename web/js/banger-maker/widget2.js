
document.addEventListener("DOMContentLoaded", () => {
  //ici on ajoute un bouton qui on click va chercher l'item qui à le json du song

})


//
export function playSongWithInstrument(song){
    console.log(song)
    const dist = new Tone.Distortion(0.8).toDestination();
    const synth = new Tone.PolySynth(Tone.Synth).connect(dist).toDestination();

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
//

function playnote(synth,note,starttime){
    synth.triggerAttack(note, starttime)

}

/**
 *
 * @param synth
 * @param note
 * @param endtime
 */
//

function stopnote(synth,note,endtime){
    console.log("stop" + note)
    synth.triggerRelease(note,endtime)
}
