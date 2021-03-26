const app =new Vue({

    el: "#app",
    data:{
             active: 0,
            categories: [
            "Comment créer son banger ?",
            "Ecouter les bangers",
            "Ajouter un banger"
],
        riffs:[

        ],
        newRiff: {
            "name": "",
            "genre": "",
            "author": "",
            "customfile":[],
            "description": ""
        },
        errorRiff: {
            "name": "erreur",
            "genre": "",
            "author": "",
            "customfile":[],
            "description": ""
        },
    },
    computed:{
    },
    methods:{
    activate(index) {
    this.active = index;
},
        selectRiffById:function(id) {
            let filteredRiff = this.errorRiff

            this.riffs.forEach(
                (e)=>{
                    if (e._id == id)
                         filteredRiff = e
                }
            )
            return filteredRiff
        },

        add:function(){
            this.newRiff.customfile = encodeURIComponent(JSON.stringify(window.song))
            console.log(encodeURIComponent(JSON.stringify(window.song)))
            this.ajax("/riff/add",this.newRiff).then(function(response){
                this.riffs = response.body
                this.active = 1
            })
            this.$http.get("/riff/list").then(function(response){
                this.riffs = response.body
            })

        },
        deleteriff:function(supressId){
            this.ajax("/riff/remove",{ "_id":supressId })
                .then(function(response){
                    this.$http.get("/riff/list").then(function(response){
                        this.riffs = response.body
                    })
             })

        },
        playsong:function(customfile){

            window.songtoplay = JSON.parse(customfile)
            document.getElementById("invisible-button-play").click()

        },
        initForm:function(){
            this.newRiff = {
            }
        },
        ajax: function(url, params = { } ) {
            let s = url+"?";
            for(let key in params) {
                s += key + "=" + params[key] +"&"
            }
            console.log(s)
            return this.$http.get(s);
        },
        goToPlayground:function() {
            this.active = 2
        }
    },
    mounted:function(){
        this.$http.get("/riff/list").then(function(response){
            this.riffs = response.body
        })
        this.initForm()
    }

})
